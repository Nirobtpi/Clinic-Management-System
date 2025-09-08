<?php

namespace Modules\Language\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Language\App\Models\Language;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages=Language::all();

        return view('language::index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('language::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request) {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'lang_code' => 'required|string|unique:languages,code',
    //         'status' => 'required',
    //     ],[
    //         'name.required' => 'Name is required.',
    //         'name.string' => 'Name must be string.',
    //         'name.max' => 'Name must be less than 255 characters.',
    //         'lang_code.required' => 'Language Code is required.',
    //         'lang_code.string' => 'Language Code must be string.',
    //         'lang_code.unique' => 'Language Code must be unique.',
    //         'status.required' => 'Status is required.',
    //     ]);

    //     if($request->is_default == 1) {
    //         Language::where('default', 1)->update(['default' => 0]);
    //     }

    //     Language::create([
    //         'name' => $request->name,
    //         'code' => $request->lang_code,
    //         'status' => $request->status,
    //         'default' => $request->is_default == 1 ? 1 : 0,
    //         'language_direction' => $request->language_direction
    //     ]);

    //     $langCode = $request->lang_code;
    //     $targetPath = resource_path("lang/{$langCode}.json");
    //     // return $targetPath;


    //     if (!File::exists($targetPath)) {
    //         $sourcePath = resource_path("lang/en.json");

    //         if (File::exists($sourcePath)) {
    //             $data = json_decode(File::get($sourcePath), true);
    //         } else {
    //             $data = [];
    //         }

    //         File::put($targetPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    //     }
    //     $notification = array(
    //         'message' => 'Language created successfully.',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('language.index')->with($notification);
    // }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'lang_code' => 'required|string|unique:languages,code',
            'status' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be string.',
            'name.max' => 'Name must be less than 255 characters.',
            'lang_code.required' => 'Language Code is required.',
            'lang_code.string' => 'Language Code must be string.',
            'lang_code.unique' => 'Language Code must be unique.',
            'status.required' => 'Status is required.',
        ]);

        $langCode = $request->lang_code;
        $targetPath = lang_path("{$langCode}/messages.php");
        // return $targetPath;
        if(!File::exists($targetPath)){
            File::makeDirectory(lang_path($langCode), 0755, true);
        }

        if (!File::exists($targetPath)) {
            $sourcePath = lang_path("en/messages.php");

            if (File::exists($sourcePath)) {
                $data = include($sourcePath);
            } else {
                $data = [];
            }

            File::put($targetPath, "<?php\n return " . var_export($data, true) . ";\n");
        }

        if($targetPath){
            if($request->is_default == 1) {
                Language::where('default', 1)->update(['default' => 0]);
            }

            Language::create([
                'name' => $request->name,
                'code' => $request->lang_code,
                'status' => $request->status,
                'default' => $request->is_default == 1 ? 1 : 0,
                'language_direction' => $request->language_direction
            ]);

            $notification = array(
                'message' => 'Language created successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('language.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Language not created.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('language::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $language=Language::findOrFail($id);
        return view('language::edit',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be string.',
            'name.max' => 'Name must be less than 255 characters.',
            'status.required' => 'Status is required.',
        ]);

        if($request->is_default == 1) {
            Language::where('default', 1)->update(['default' => 0]);
        }
        if($request->is_default == '') {
            Language::where('id',1)->update(['default' => 1]);
        }

        Language::findOrFail($id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'default' => $request->is_default == 1 ? 1 : 0,
            'language_direction' => $request->language_direction
        ]);

        if($id ==1) {
            Language::where('id',1)->update(['default' => 1]);
        }

        $notification = array(
            'message' => 'Language updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('language.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
       $lang= Language::findOrFail($id);

        $langCode = $lang->code;
        $targetPath = lang_path("lang/{$langCode}");
        if (File::exists($targetPath)) {
            File::delete($targetPath);
        }
        $lang->delete();

        $notification = array(
            'message' => 'Language deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('language.index')->with($notification);
    }

    public function themeLanguage(Request $request){

        $langCode = $request->theme_lang;
        $targetPath = lang_path("{$langCode}/messages.php");
        if (File::exists($targetPath)) {
          $datavalues = include($targetPath);
          return view('language::theme_language',compact('datavalues'));

        }else{
            $notification = array(
                'message' => 'Language not found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

    }

    public function themeLanguageUpdate(Request $request){

        $toArray=[];

        foreach($request->values as $key => $value){
            $toArray[$key] = $value;
        }

        $langCode = $request->theme_lang;

        $targetPath = lang_path("{$langCode}/messages.php");

        if (File::exists($targetPath)) {
            File::put($targetPath, "<?php\n return " . var_export($toArray, true) . ";\n");

            $notification = array(
                'message' => 'Language updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Language not found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

    }


}
