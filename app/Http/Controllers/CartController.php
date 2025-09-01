<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart=session()->get('cart',[]);

        return view('cart.index',compact('cart'));
    }

    public function add(Request $request){
        $cart=session()->get('cart',[]);

        // return $request->all();
        $id=$request->id;
        $name = $request->input('name');
        $price = $request->input('price');
        $qty = $request->input('qty', 1);
        if(isset($cart[$id])){
            $cart[$id]['qty'] += $qty;
        }else{
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'qty' => $qty,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with(['message'=>'Product added to cart','alert-type'=>'success']);
        // return response()->json(['message' => 'Product added to cart']);
    }

    public function remove($id){
        $cart=session()->get('cart',[]);
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect()->back()->with(['message'=>'Product removed from cart','alert-type'=>'success']);
    }
}
