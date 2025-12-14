<?php

namespace Modules\FrontendManagment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\FrontendManagment\App\Models\FrontendSection;

class FrontendManagmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jsonUrl = resource_path('views/admin/settings.json');
        $settings = json_decode(file_get_contents($jsonUrl), true);

        return view('frontendmanagment::index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontendmanagment::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('frontendmanagment::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($key)
    {
        $lang_code = request()->get('lang_code', 'en');
        $jsonUrl = resource_path('views/admin/settings.json');
        $sections = json_decode(file_get_contents($jsonUrl), true);

        $section=$sections[$key] ?? null;
        $contentType=isset($section['content']) ? 'content' : (isset($section['element']) ? 'element' : null);

        if(!$contentType){
            abort(404, "Content or Element not found for section: $key");
        }
        $datakeys= $key . ".".$contentType;
        $content=$section[$contentType] ?? null;

        $frontend=FrontendSection::where('data_keys',$datakeys)->first();

        if($lang_code == 'en'){
            $data_values=$frontend ? json_decode($frontend->data_values,true) : [];
        }else{
            if($frontend){
                $translations=json_decode($frontend->data_translations,true) ??[];

                $translate=collect($translations)->first(function($item) use($lang_code){
                    return $item['language_code'] == $lang_code;
                });

              if($translate){
                $data_values=$translate['values'] ?? [];

                $frontend->data_translations=json_encode($translations);
                $frontend->save();

              }else{
                    $data_values = json_decode($frontend->data_values, true) ?? [];

                    if (isset($section[$contentType]['images'])) {
                        $data_values['images'] = array_fill_keys(array_keys($section[$contentType]['images']), '');
                    }

                     // Add new language entry to translations
                    $translations[] = [
                        'language_code' => $lang_code,
                        'values' => $data_values
                    ];

                    // Save updated translations
                    $frontend->data_translations = json_encode($translations);
                    $frontend->save();

                }
            }else{
                $data_values=[];
            }
        }

        $imageCount = isset($content['images']) ? count($content['images']) : 0;


        return view('frontendmanagment::edit',[
            'section'=>$section,
            'data_keys'=>$datakeys,
            'content_type'=>$contentType,
            'content'=>$content,
            'data_values'=>$data_values,
            'lang_code'=>$lang_code,
            'imageCount'=>$imageCount,
            'key'=>$key,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
