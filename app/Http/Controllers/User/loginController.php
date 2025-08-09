<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('user.user_register');
    }

    public function login(Request $request)
    {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ]);
       $user = User::where('email', $request->email)->first();

       if($user){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if($user->role === 'doctor'){
                return redirect()->route('doctor.dashboard');
            }else{
                return redirect()->route('user.dashboard');
            }
        }else{
            $notification = [
                'message' => 'Invalid email or password',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.login')->with($notification);
        }
       }else{
        $notification = [
            'message' => 'Invalid email or password',
            'alert-type' => 'error'
        ];
        return redirect()->route('user.login')->with($notification);
       }


    }

    public function logout(){
        Auth::logout();
        $notification = [
            'message' => 'Successfully logged out',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.login')->with($notification);
    }
}
