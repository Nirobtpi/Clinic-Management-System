<?php

use Illuminate\Support\Facades\Session;
function admin_lang(){
    return Session::get('admin_lang');
}
function font_lang(){
    return Session::get('font_lang');
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

function generateLang($path=''){
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
    $lanPath = resource_path('lang/en.json');
    $lanPath2 = resource_path('lang/bn.json');

    file_put_contents($lanPath, $jsonData);

    file_put_contents($lanPath2, $jsonData);
    // file_put_contents(base_path('lang/en/messages.php'), "<?php\n return " . var_export($modifiedData, true) . ";\n");
    // file_put_contents(base_path('lang/bn/messages.php'), "<?php\n return " . var_export($modifiedData, true) . ";\n");

    return "en.json updated successfully!";

}

?>
