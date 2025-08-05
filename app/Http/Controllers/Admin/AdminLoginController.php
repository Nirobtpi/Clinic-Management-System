<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function loginPage(){
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view("admin.login");
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $user = Admin::where("email", $request->email)->first();
        if($user){
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
                $request->session()->regenerate();
                $notification="Login Successfully";
                $notification=['message'=>$notification,'alert-type'=>'success'];
                return redirect()->route("admin.dashboard")->with($notification);
            }else{
                $notification="User email or password incorrect";
                $notification=['message'=>$notification,'alert-type'=>'error'];
                return redirect()->route("admin.login")->with($notification);
            }
        }else{
            $notification="User Not Found";
            $notification=['message'=>$notification,'alert-type'=>'error'];
            return redirect()->back()->with($notification);
        }

    }
    public function logout(){
        Auth::guard('admin')->logout();
        $notification= 'Logout Successfully';
        $notification=['message'=>$notification,'alert-type'=> 'success'];
        return redirect()->route('login')->with($notification);
    }
}
