<?php

namespace App\Http\Controllers\Email;

use Exception;
use App\Models\User;
use App\Helpers\MailHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Models\Admin\EmailTemplate;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function showForgetPasswordForm(){

        return view('forget_password');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ],[
            'email.exists' => 'This email is not registered',
            'email.required' => 'Please enter your email address',
        ]);

        MailHelper::mailable();

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function submitForgetPasswordForm(Request $request){
       $request->validate([
           'email' => 'required|email|exists:users',
       ],[
           'email.exists' => 'This email is not registered',
           'email.required' => 'Please enter your email address',
       ]);

       $user=User::where('email',$request->email)->first();

       if($user){
        $user->forget_password_token = Str::random(100);
        $user->save();

        MailHelper::mailable();

        try{

            $reset_link=route('user.reset.password').'?token='.$user->forget_password_token.'&email='.$user->email;
            $link = "<a target='_blank' href='{$reset_link}'>{$reset_link}</a>";

            $template=EmailTemplate::where('name','Reset Password')->first();
            $subject=$template->subject;
            $message= $template->description;
            $message = str_replace('{{user_name}}',$user->name,$message);
            $message = str_replace('{{verification_link}}',$link,$message);

            Mail::to($user->email)->send(new ResetPasswordMail($user,$message,$subject));

        }catch(Exception $e){
            Log::info('Order confirmation mail faild'.$e->getMessage());

        }

        $notification=[
            'alert-type' => 'success',
            'message' => 'We have e-mailed your password reset link!'
        ];

        return redirect()->back()->with($notification);

       }else{
        $notification=[
            'alert-type' => 'error',
            'message' => 'This email is not registered'
        ];
        return redirect()->back()->with($notification);
       }

    }

    public function showResetPasswordForm(Request $request){

        $token = $request->query('token');
        $email = $request->query('email');

        return view('auth.reset_password',compact('token','email'));
    }

    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $token = $request->forget_token;
        $email = $request->email;


        $user=User::where('email',$email)->first();

        if($user){
            if($user->forget_password_token == $token){
                $user->password=Hash::make($request->password);
                $user->forget_password_token=null;
                $user->save();
                $notification=[
                    'alert-type' => 'success',
                    'message' => 'Password reset successfully'
                ];
                return redirect()->route('user.login')->with($notification);
            }else{
                $notification=[
                    'alert-type' => 'error',
                    'message' => 'Something went wrong'
                ];
                return redirect()->back()->with($notification);
            }
        }


    }
}
