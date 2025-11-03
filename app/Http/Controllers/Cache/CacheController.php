<?php

namespace App\Http\Controllers\Cache;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

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
        return $coll->countBy();
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
    $collection = collect([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 100],
    ]);

   $res= $collection->contains('product', 'Desk');
   dd($res);


    }
}
