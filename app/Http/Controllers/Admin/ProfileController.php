<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        return view("admin.profile.profile");
    }

    public function update(Request $request,$id){
        $admin=Admin::findOrFail($id);

        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:admins,email,'.$admin->id],
            'photo'=>['nullable','mimes:jpg,png,jpeg','max:2048'],
        ]);

        $data=[];
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['state']=$request->state;
        $data['zip_code']=$request->zip_code;
        $data['country']=$request->country;
        $data['about_me']=$request->about_me;
        $data['birthday']=$request->birthday;

        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            // $ext=$photo->getClientOriginalExtension();
            // $filename=time().'.'.$ext;
            // $photo->move('uploads/admin/',$filename);
            // $data['photo']='uploads/admin/'.$filename;
           $photodb= uploadFile($photo,'uploads/admin/',$admin->photo);
           $data['photo']=$photodb;

            // if($admin->photo && file_exists(public_path('uploads/admin/'.$filename))){
            //     unlink(public_path('uploads/admin/'.$filename));
            // }
        }
        $admin->update($data);

        $notification="Profile Updated Successfully";
        $notification=['message'=>$notification,'alert-type'=>'success'];
        return redirect()->route("admin.profile")->with($notification);
    }

    public function passwordUpdate(Request $request,$id){
        $admin = Admin::findOrFail($id);
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required','confirmed'],
        ]);
        if(Hash::check($request->old_password,$admin->password)){
            $admin->update([
            'password'=>Hash::make($request->password),
            ]);
            $notification="Password Updated Successfully";
            $notification=['message'=>$notification,'alert-type'=>'success'];
            return redirect()->route("admin.profile")->with($notification);
        }else{
            $notification="Old Password Not Match";
            $notification=['message'=>$notification,'alert-type'=>'error'];
            return redirect()->back()->with($notification);
        }
    }

}
