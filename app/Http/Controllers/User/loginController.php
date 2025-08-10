<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
            if($user->status === 'active'){
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
                    'message' => 'Inactive account Please contact support',
                    'alert-type' => 'error'
                    ];

                    return redirect()->route('user.login')->with($notification);
            }
        }else{
           $notification = [
                    'message' => 'Invalid email',
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

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'birthday' => 'required|date',
            'password' => 'required|string|min:4|confirmed',
            'blood_group' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
        ]);

        if(Route::has('user.register.post')){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'password' => bcrypt($request->password),
                'blood_group' => $request->blood_group,
                'gender' => $request->gender,
                'address_line_one' => $request->address,
                'role' => 'user'
            ]);
        }

        $notification = [
            'message' => 'Registration successful',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.login')->with($notification);
    }
}
