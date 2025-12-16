<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\FrontendManagment\App\Models\FrontendSection;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

function admin_lang(){
    return Session::get('admin_lang', 'en');
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


 function getContent($key, $singleQuery = false, $limit = null , $orderById = false){
    $query = FrontendSection::query();

    if($singleQuery){
       $content = $query->where('data_keys', $key)->orderBy('id', 'desc')->first();
    }else{

        if($limit != null){
            $query->where('data_keys', $key)->limit($limit);
        }
        if($orderById){
           $query->orderBy('id');
        }else{
           $query->orderBy('id', 'desc');
        }

        $content = $query->where('data_keys', $key)->get();
    }
    return $content;
 }

 function html_decode($text)
{
    $decode_text = htmlspecialchars_decode($text, ENT_QUOTES);
    return $decode_text;
}

function getTranslatedValue($content, $key)
{
    if (!$content) {
        return '';
    }

    $lang = 'en';

    $front_lang = Session::get('front_lang');

    if ($front_lang) {
        $lang = $front_lang;
    }

    // If translations exist and language is not English
    if ($lang !== 'en') {
        $translations = json_decode($content->data_translations, true);
        // return $translations;


        // Loop through the translations to find the matching language code
        foreach ($translations as $translation) {
            if (isset($translation['language_code']) && $translation['language_code'] === $lang) {
                // Return the translated value if it exists
                $decode_value = isset($translation['values'][$key]) ? $translation['values'][$key] : '';
                return html_decode($decode_value);
            }
        }


        // If no translation found for requested language, return default string
        $content= json_decode($content->data_values, true);

        $decode_value = isset($content[$key]) ? $content[$key] : '';

        return html_decode($decode_value);
    }

    $content= json_decode($content->data_values, true);

    // Fallback to English content
    $decode_value = isset($content[$key]) ? $content[$key] : '';

    return html_decode($decode_value);
}

//   function getTranslatedValue($data, $key){


//     if(!$data){
//         return ""; // Return empty string if data is null
//     }


//     $lang = "en";

//     $front_lang = session()->get('font_lang');
//     if($front_lang){
//         $lang = $front_lang;
//     }

//     if($lang !== 'en'){

//         $translations = json_decode($data->data_translations, true);

//         foreach($translations as $translation){
//             if(isset($translation['language_code']) && $translation['language_code'] == $lang){
//                $decodeValue = isset($translation['values'][$key]) ? $translation['values'][$key] : '';

//                return html_decode($decodeValue);
//             }
//         }

//         $decodeValue = isset($data->data_values[$key]) ? $data->data_values[$key] : '';

//         return html_decode($decodeValue);

//     }

//     $decodeValue = isset($data->data_values[$key]) ? $data->data_values[$key] : 'okk';

//     return html_decode($decodeValue);
//   }


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
function getDefaultLanguageByApi() {

    $cookieName = 'default_language';
    $cookieDuration = 60 * 24 * 30; // 1 month in minutes

    if (Cookie::has($cookieName)) {
        return Cookie::get($cookieName);
    }


    // Get the real user IP address, considering proxies and load balancers
    $userIp = request()->ip();


    // If we're behind a proxy/load balancer, try to get the real IP from headers
    if (request()->hasHeader('X-Forwarded-For')) {
        $ips = explode(',', request()->header('X-Forwarded-For'));
        $userIp = trim($ips[0]);
    } elseif (request()->hasHeader('X-Real-IP')) {
        $userIp = request()->header('X-Real-IP');
    } elseif (request()->hasHeader('CF-Connecting-IP')) {
        // Cloudflare
        $userIp = request()->header('CF-Connecting-IP');
    }


    // Validate IP address
    if (!filter_var($userIp, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        $userIp = request()->ip(); // Fallback to default IP detection
    }


    // Log the IP being used for debugging
    Log::info('Detected user IP for country detection: ' . $userIp);

    try {
        $response = Http::timeout(10)->get("http://ip-api.com/json/{$userIp}?fields=countryCode");


        if ($response->successful()) {

            $jsonData = $response->json();
            $countryCode = $jsonData['countryCode'] ?? '';

            Log::info('IP API Response: ' . json_encode($jsonData));

            if ($countryCode && $countryCode !== '') {
                Cookie::queue(Cookie::make($cookieName, $countryCode, $cookieDuration));
                return $countryCode;
            }
        } else {
            Log::warning('IP API request failed with status: ' . $response->status());
        }
    } catch (\Exception $e) {
        // Log error if needed
        Log::warning('Failed to get country code from IP API: ' . $e->getMessage());
    }

    // Fallback: try alternative API
    try {
        Log::info('Trying alternative IP API...');
        $response = Http::timeout(10)->get("https://ipapi.co/{$userIp}/json/");

        if ($response->successful()) {
            $jsonData = $response->json();
            $countryCode = $jsonData['country_code'] ?? '';

            Log::info('Alternative IP API Response: ' . json_encode($jsonData));

            if ($countryCode && $countryCode !== '') {
                Cookie::queue(Cookie::make($cookieName, $countryCode, $cookieDuration));
                return $countryCode;
            }
        }
    } catch (\Exception $e) {
        Log::warning('Alternative IP API also failed: ' . $e->getMessage());
    }

    // Final fallback: return a default country code (US)
    Log::warning('All IP APIs failed, using default country: US');
    return 'US';
}

?>
