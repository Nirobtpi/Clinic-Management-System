<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Email;
use App\Models\Admin\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index()
    {
        $email=Email::first();
        return view('admin.email.index',compact('email'));
    }

    public function update(Request $request)
    {
        $email=Email::first();
        $email->update([
            'email'=>$request->email,
            'sender_name'=>$request->sender_name,
            'mail_host'=>$request->mail_host,
            'smtp_user_name'=>$request->smtp_user_name,
            'smtp_password'=>$request->smtp_password,
            'smtp_port'=>$request->smtp_port,
            'mail_encryption'=>$request->mail_encryption

        ]);
        $notification = [
            'message' => 'Email updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function emailTemplate(){
        $templates=EmailTemplate::get();
        return view('admin.email.email_template',compact('templates'));
    }

    public function emailTemplateEdit($id)
    {
        $template=EmailTemplate::findOrFail($id);
        return view('admin.email.template_edit',compact('template'));
    }

    public function emailTemplateUpdate(Request $request,$id)
    {
        $request->validate([
            'subject'=>'required',
            'description'=>'required',
        ]);

        $template=EmailTemplate::findOrFail($id);
        $template->update([
            'subject'=>$request->subject,
            'description'=>$request->description,
        ]);
        $notification = [
            'message' => 'Email template updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('email.template')->with($notification);
    }
}
