<?php

namespace App\Http\Controllers\Cache;

use App\Models\User;
use App\Models\Comment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CacheController extends Controller
{
    public function clearCache(){




        // Cache::put('name', 'Nur Alam Nirob', 600);
        // $value = Cache::pull('name');


        // return $value;
        // $user = Cache::rememberForever('users', function () {
        //     return User::with('profile')->get();
        // });
        // return $user;
        $coll = collect([1, 2, 3, 4, 5]);
        // return $coll->avg();
        // return $coll->map(function ($item, $key) {
        //     return $item * 2;
        // });
        // return $coll->countBy();
        // return $coll->chunk(2);
        // $users = User::with('profile')->get();
        // $users->pluck('name')->all();
        // return $users;

        // foreach($users->chunk(3) as $chunk){
        //     foreach($chunk as $user){
        //         echo $user->name."<br>";
        //     }
        //     echo "----<br>";
        // }
        //  $collection = collect([
        //       [1, 2, 3],
        //       [4, 5, 6],
        //       [7, 8, 9],
        //   ]);

        //    return $collapsed = $collection->collapse();

        //     $collapsed->all();
        //     return $collapsed;

        // $collection = collect([
        //     ['name' => 'Alice', 'age' => 30],
        //     ['name' => 'Bob', 'age' => 25],
        //     ['name' => 'Charlie', 'age' => 35],
        // ]);
        // $collection =collect([
        //     'name',
        //     'age',
        // ]);

        // $combined = $collection->combine(['Saba', 8]);
        // return $combined;

        // $new= $collection->contains(300);
        // dd($new);

        // $collection = collect(['John', 'Jane', 'Doe', 'Smith']);

        // $combined = $collection->concat(['Alice', 'Bob']);
        // $combined = $combined->concat(['Charlie']);
        // // return $combined;
        // $new = $combined->filter(function ($value, $key) {
        //     return strlen($value) <= 3;
        // });
        // return $new;
        // $collection = collect([1, 2, 3]);

        // $new = $collection->contains(function ($value, $key) {
        //     return $value > 9;
        // });
        // // return $new;
        // $new =$collection->crossJoin(['A', 'B'], [true, false]);
        // return $new;
    //     $collection = collect([
    //         ['name' => 'Sally'],
    //         ['school' => 'Arkansas'],
    //         ['age' => 28]
    //     ]);


    //     $flattened = $collection->flatMap(function (array $values) {
    //         return array_map('strtoupper', $values);
    //     });

    //    return $flattened->all();
    // $collection = collect([
    //     ['product' => 'Desk', 'price' => 200],
    //     ['product' => 'Chair', 'price' => 100],
    // ]);

//    $res= $collection->contains('product', 'Desk');
//    dd($res);
    // $collect = collect([1,2,2,2,2,2,3,4,5]);
    // return $collect->countBy();

    $collection = collect([
        ['id' => 1, 'tags' => '["Laravel", "PHP"]'],
        ['id' => 2, 'tags' => '["Vue", "JavaScript"]'],
        ['id' => 3, 'tags' => null],
        ['id' => 4, 'tags' => '["PHP", "React"]'],
    ]);

    $tags = $collection
    ->whereNotNull('tags')
    ->map(function ($item) {
        return json_decode($item['tags'], true);
    })
    ->flatten()
    ->unique()
    ->all();

    $suffal= collect(['a','b','c','d'])->shuffle()->all();

    $cacheKey = 'unique_tags';
    $cacheDuration = 3600; // Cache duration in seconds (1 hour)

    // Cache::put($cacheKey, $tags, $cacheDuration);
    Cache::rememberForever($cacheKey, function() use ($tags) {
        return $tags;
    });

    Cache::forget($cacheKey);


    function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {

            return $_SERVER['REMOTE_ADDR'];
        }
    }
    // echo getUserIP();
    // echo  $_SERVER['HTTP_USER_AGENT'];











    // $s=trim(fgets(STDIN));

    // $numbers=[
    //     'zero'=>0,
    //     'one'=>1,
    //     'two'=>2,
    //     'three'=>3,
    //     'four'=>4,
    //     'five'=>5,
    //     'six'=>6,
    //     'seven'=>7,
    //     'eight'=>8,
    //     'nine'=>9,
    // ];
    // $num=$numbers[$s] ?? 'Not found';
    // if($num % 2 == 0){
    //     echo 0;
    // }else{
    //     echo 1;
    // }

    // $n=intval(trim(fgets(STDIN)));
    // $steps=0;

    // while($n >1){
    //     if($n % 2 ==0){
    //         $n = $n /2;
    //     }elseif($n % 3 ==0){
    //         $n = $n /3;
    //     }else{
    //         $n = $n -1;
    //     }
    //     $steps++;
    // }

    // echo $steps;

    // function removeSpecialChars($text){
    //     $specialChars = ['.', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', ','];
    //     foreach ($specialChars as $char) {
    //         $text = str_replace($char, '', $text);
    //     }
    //     return $text;
    // }

    // $text = trim(fgets(STDIN));
    // $cleanedText = removeSpecialChars($text);
    // echo $cleanedText;

    // retry(3,function($att){
    //     echo "Attempt number: ".$att."<br>";
    //     // Simulate some work
    //     sleep(1);
    //     if($att == 3){
    //         echo "Succeeded on attempt ".$att."<br>";
    //     }else{
    //         throw new \Exception("Failed attempt ".$att);
    //     }
    // });

    // return Cache::get($cacheKey);

    // $app=Appointment::selectRaw('MAX(id) as id, user_id')->where('user_id', Auth::user()->id)->where('status', 'pending')->groupBy('user_id')->get();
    // $getApp=$app->pluck('id');
    // $apps=Appointment::whereIn('id', $getApp)->get();
    // // return $apps;

    // $apps=DB::table('appointments')
    //     ->selectRaw('MAX(id) as id, user_id')
    //     ->where('status', 'pending')
    //     ->groupBy('user_id')
    //     ->pluck('id');
    // return $apps;



    }

    public function comment(Request $request){

        $comments= Comment::latest()->paginate(3);

        $heroContent = getContent('hero_section.content', true);
        Session::put('front_lang', 'bn');

        $name = getTranslatedValue($heroContent, 'subtitle');

        return $name;

        if($request->ajax())
        {
            $comments= Comment::latest()->paginate(3);
            $has_more_page = null;
            $has_pagination = false;
            $next_page = null;

            if($comments->hasMorePages()){
                $has_more_page = $comments->nextPageUrl();
                $has_pagination = true;
                $next_page = $comments->nextPageUrl();
            }

            $html = view('ajax_comment', compact('comments'))->render();

            return response()->json([
                'html' => $html,
                'has_more_page' => $has_more_page,
                'has_pagination' => $has_pagination,
                'next_page_url' => $next_page,
            ]);
        }

        return view('comment', compact('comments'));
    }



}
