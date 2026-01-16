<?php

namespace Modules\FrontendManagment\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        // $getcontent = getcontent('hero_section.content');
        // $val = getTranslatedValue($getcontent, 'title');
        // return $val;

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
            'contentType'=>$contentType,
            'content'=>$content,
            'data_values'=>$data_values,
            'lang_code'=>$lang_code,
            'imageCount'=>$imageCount,
            'key'=>$key,
            'frontend'=>$frontend
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $key, $id = null) {

        // get the language code
        $lang_code = $request->lang_code;

        if(!$lang_code){
            return redirect()->back()->with('error', 'Language code is required.');
        }
        // laod json file and get section
        $jsonUrl = resource_path('views/admin/settings.json');
        $sections = json_decode(file_get_contents($jsonUrl), true);

        if(!isset($sections[$key])){
            abort(404, "Section not found for key: $key");
        }

        $section = $sections[$key];
        $contentType = isset($section['content']) ? 'content' : (isset($section['element']) ? 'element' : null);

        if(!$contentType){
            abort(404, "Content or Element not found for section: $key");
        }

        $data_keys = $key . "." . $contentType;
        $data = $request->except(['_token', '_method', 'type','lang_code']);

        $frontend = $id ? FrontendSection::find($id) : new FrontendSection();

        // Normalize stored JSON values so we can safely access images/text
        $dataValues =json_decode($frontend->data_values, true) ?? [];
        $translations = json_decode($frontend->data_translations, true) ?? [];

        $textData = [];
        $imageData = [];

        if(isset($section[$contentType]['images'])){
            // return $section[$contentType]['images'];

            foreach($section[$contentType]['images'] as $imageKey => $imageInfo){
                // return $imageKey;
                if($request->hasFile($imageKey)){

                   $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];

                   $extension = $request->file($imageKey)->getClientOriginalExtension();

                    if (!in_array($extension, $allowedExtensions)) {
                        return redirect()->back()->with('error', 'Invalid image format. Allowed formats: jpeg, jpg, png, gif, webp.');
                    }

                    $old_file = null;
                    $image = $request->file($imageKey);
                    $imageName = "image-frontend-".time() . '.' . $image->getClientOriginalExtension();

                    if($lang_code == 'en'){
                        $old_file = $dataValues['images'][$imageKey] ?? null;
                    }else{
                        foreach ($translations as $translation) {
                            if ($translation['language_code'] === $lang_code && isset($translation['values']['images'][$imageKey])) {
                                $old_file = $translation['values']['images'][$imageKey];
                                break;
                            }
                        }
                    }

                    if ($old_file && File::exists(public_path($old_file))) {
                        unlink(public_path($old_file));
                    }

                    $image->move(public_path('uploads/website-images'), $imageName);
                    $imageData[$imageKey] = 'uploads/website-images/' . $imageName;


                }else{

                     // Keep existing image based on language
                    if ($lang_code === 'en') {
                        if (isset($dataValues['images'][$imageKey])) {
                            $imageData[$imageKey] = $dataValues['images'][$imageKey];
                        }
                    } else {
                        // For non-English, get image from translations first
                        $translations = json_decode($frontend->data_translations, true) ?? [];
                        $foundInTranslation = false;

                        foreach ($translations as $translation) {
                            if ($translation['language_code'] === $lang_code && isset($translation['values']['images'][$imageKey])) {
                                $imageData[$imageKey] = $translation['values']['images'][$imageKey];
                                $foundInTranslation = true;
                                break;
                            }
                        }

                        // For non-English languages, don't fallback to English images
                        if (!$foundInTranslation) {
                            $imageData[$imageKey] = '';
                        }
                    }
                }
            }
        }


        // Separate text data from the request
        foreach ($data as $key => $value) {
            if ($key !== 'images') {
                $textData[$key] = $value;
            }
        }

        // Log language code and data for debugging
        Log::info('Updating content for language: ' . $lang_code);
        Log::info('Text Data:', $textData);

          // Handle data updates based on language
        if ($lang_code === 'en') {
            // For English, update both data_values and translations
            $finalData = $textData;
            if (!empty($imageData)) {
                $finalData['images'] = $imageData;
            } elseif (isset($dataValues['images'])) {
                $finalData['images'] = $dataValues['images'];
            }

            $frontend->data_values = json_encode($finalData);

            // Update or add English translation
            $translationExists = false;

            foreach ($translations as $key => $translation) {
                if ($translation['language_code'] === 'en') {
                    $translations[$key]['values'] = $textData;
                    $translationExists = true;
                    break;
                }
            }

            if (!$translationExists) {
                $translations[] = [
                    'language_code' => 'en',
                    'values' => $textData
                ];
            }

            Log::info('Updated English data_values with images:', ['images' => $finalData['images'] ?? []]);
        } else {

            // Each language maintains its own independent image state
            $translationExists = false;
            $finalTranslationData = $textData;

            // Get existing translation data to preserve images
            $existingTranslation = null;
            foreach ($translations as $translation) {
                if ($translation['language_code'] === $lang_code) {
                    $existingTranslation = $translation;
                    break;
                }
            }

            // Include images in translation data
            if (!empty($imageData)) {
                // New images uploaded, use them
                $finalTranslationData['images'] = $imageData;
                Log::info('Using new uploaded images for language: ' . $lang_code, ['images' => $imageData]);
            } elseif ($existingTranslation && isset($existingTranslation['values']['images'])) {
                // No new images, preserve existing images from this language's translation
                $finalTranslationData['images'] = $existingTranslation['values']['images'];
                Log::info('Preserving existing images for language: ' . $lang_code, ['images' => $existingTranslation['values']['images']]);
            } else {
                // No existing images in translation, start with empty images for this language
                // This ensures each language starts with independent empty image state
                $finalTranslationData['images'] = array_fill_keys(array_keys($section[$contentType]['images'] ?? []), '');
                Log::info('Starting with empty images for language: ' . $lang_code, ['empty_images' => $finalTranslationData['images']]);
            }

            foreach ($translations as $key => $translation) {
                if ($translation['language_code'] === $lang_code) {
                    $translations[$key]['values'] = $finalTranslationData;
                    $translationExists = true;
                    Log::info('Updating existing translation for: ' . $lang_code);
                    break;
                }
            }

            if (!$translationExists) {
                $translations[] = [
                    'language_code' => $lang_code,
                    'values' => $finalTranslationData
                ];
                Log::info('Creating new translation for: ' . $lang_code);
            }

            // Handle new records without English data
            if (empty($frontend->data_values)) {
                $frontend->data_values = json_encode([
                    'images' => $imageData
                ]);

                // Add default English translation if not exists
                $hasEnglishTranslation = false;
                foreach ($translations as $translation) {
                    if ($translation['language_code'] === 'en') {
                        $hasEnglishTranslation = true;
                        break;
                    }
                }

                if (!$hasEnglishTranslation) {
                    $translations[] = [
                        'language_code' => 'en',
                        'values' => []
                    ];
                }
            }
        }

        // Set data_keys if it's a new record
        if (!$frontend->data_keys) {
            $frontend->data_keys = $data_keys;
        }

        // Save the updated translations
        $frontend->data_translations = json_encode($translations);

        // Log final translations for verification
        Log::info('Final translations:', ['translations' => $translations]);

        $frontend->save();

        $notify_message = trans('Update successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
