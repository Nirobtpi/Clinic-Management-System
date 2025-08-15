<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;


class UserController extends Controller
{
    use ValidatesRequests;
    public function changePasswordPage(){
        return view('change_password');
    }

    public function passwordUpdate(Request $request, $id){
        $userUpdate=User::findOrFail($id);
        $rules=[
            'old_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ];
        $messages=[
            'old_password.required'=>'Please enter old password',
            'password.required'=>'Please enter new password',
            'password_confirmation.required'=>'Please enter confirm password',
        ];

        $this->validate($request, $rules, $messages);
        if(Hash::check($request->old_password, $userUpdate->password)){
            $userUpdate->password=Hash::make($request->password);
            $userUpdate->save();
            $notification=[
                'message'=>'Password updated successfully',
                'alert-type'=>'success'
            ];
            return back()->with($notification);
        }else{
            $notification=[
                'message'=>'Old password not match',
                'alert-type'=>'error'
            ];
            return back()->with($notification);
        }

    }
}
