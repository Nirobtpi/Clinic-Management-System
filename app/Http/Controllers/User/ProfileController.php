<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Clinic;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profileView(){
        $cities=City::all();
        $states=State::all();
        $countries=Country::all();
        return view('user.user_profile',compact('cities','states','countries'));
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'birthday'=>'date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->hasFile('profile_image')) {
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'), $imageName);
            $user->photo = 'uploads/users/' . $imageName;
        }
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->blood_group = $request->blood_group;
        $user->address_line_one = $request->address;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->postal_code = $request->postal_code;
        $user->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }
}
