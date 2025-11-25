<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
function admin_lang(){
    return Session::get('admin_lang');
}
function font_lang(){
    return Session::get('font_lang');
}

function uploadFile($file, $path, $oldFile = null)
{
    // Ensure path exists
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }

    // Generate unique filename
    $extension = $file->getClientOriginalExtension();
    $fileName = time() . '_' . uniqid() . '.' . $extension;
    $fullPath = $path . '/' . $fileName;

    if(env('FILESYSTEM_DISK') == 's3'){
        // Upload to S3
        $s3 = Storage::disk('s3');
        // Delete old file if exists
        if ($oldFile && $s3->exists($oldFile)) {
            $s3->delete($oldFile);
        }
        // Upload new file
        $s3->put($fullPath, file_get_contents($file), 'public');
        return $fullPath;
    }else{
        // Local upload
        $file->move(public_path($path), $fileName);
          // Delete old file if exists
        if ($oldFile && file_exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        // Return relative path (for DB store)
        return $fullPath;
    }

}

function getAllResourceFiles($path,&$result = []){
    $files=scandir($path);
    foreach ($files as $key => $file) {
        if ($file !== '.' && $file !== '..') {
            $filePath = $path . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                getAllResourceFiles($filePath, $result);
            } else {
                $result[] = $filePath;
            }
        }
    }
    return $result;
}

function getRegexBetween($text){
    preg_match_all("%\{{ __\(['|\"](.*?)['\"]\) }}%i", $text, $matches1, PREG_PATTERN_ORDER);
    preg_match_all("%\@lang\(['|\"](.*?)['\"]\)%i", $text, $matches2, PREG_PATTERN_ORDER);
    preg_match_all("%trans\(['|\"](.*?)['\"]\)%i", $text, $matches3, PREG_PATTERN_ORDER);


    // Match Blade translations like: {{ __('text') }}
   // preg_match_all('/\{\{\s*__\(\s*[\'\"](.*?)[\'\"]\s*\)\s*\}\}/s', $text, $matches1, PREG_PATTERN_ORDER);
    // Match @lang('text') and @lang("text")
    //preg_match_all('/@lang\(\s*[\'\"](.*?)[\'\"]\s*\)/s', $text, $matches2, PREG_PATTERN_ORDER);
   // // Match trans('text') and trans("text")
   // preg_match_all('/\btrans\(\s*[\'\"](.*?)[\'\"]\s*\)/s', $text, $matches3, PREG_PATTERN_ORDER);

    $allData = array_merge($matches1[1], $matches2[1], $matches3[1]);
    $data=[];

    foreach($allData as $item){
       if (!empty($item)) {
            // foreach ($item as $val) {
                $data[$item] = $item;
        //    }
        }
    }
    return $data;
}

function generateLangJson($path=''){
    $paths=getAllResourceFiles(resource_path('views'));

    $paths = array_merge($paths, getAllResourceFiles(base_path('Modules')));


    $AllData = [];

    foreach ($paths as $key => $path) {
        $AllData[] = getRegexBetween(file_get_contents($path));
    }

    $modifiedData = [];

    foreach ($AllData as  $value) {
        if (!empty($value)) {
            foreach ($value as $val) {
                $modifiedData[$val] = $val;
            }
        }
    }

    // $modifiedData = var_export($modifiedData, true);
    // $lanPath=base_path('lang/en');
    // if(!is_dir($lanPath)){
    //     mkdir($lanPath, 0777, true);
    // }

    // JSON encode

    $jsonData = json_encode($modifiedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // JSON file path
    $lanPath = lang_path('en.json');
    $lanPath2 = lang_path('bn.json');

    file_put_contents($lanPath, $jsonData);

    file_put_contents($lanPath2, $jsonData);
    // file_put_contents(base_path('lang/en/messages.php'), "<?php\n return " . var_export($modifiedData, true) . ";\n");
    // file_put_contents(base_path('lang/bn/messages.php'), "<?php\n return " . var_export($modifiedData, true) . ";\n");

    return "en.json updated successfully!";

}
function generateLangPhp($path=''){

    $paths=getAllResourceFiles(resource_path('views'));

    $paths = array_merge($paths, getAllResourceFiles(base_path('Modules')));
    $paths = array_merge($paths, getAllResourceFiles(base_path('app')));


    $AllData = [];

    foreach ($paths as $key => $path) {
        $AllData[] = getRegexBetween(file_get_contents($path));
    }

    $modifiedData = [];

    foreach ($AllData as  $value) {
        if (!empty($value)) {
            foreach ($value as $val) {
                $modifiedData[$val] = $val;
            }
        }
    }

    $modifiedData = var_export($modifiedData, true);
    $lanPath=base_path('lang/en');
    if(!is_dir($lanPath)){
        mkdir($lanPath, 0777, true);
    }

    file_put_contents(base_path('lang/en/messages.php'), "<?php\n return " . $modifiedData . ";\n");

    return "messages.php updated successfully!";

}

?>
