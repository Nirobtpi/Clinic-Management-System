<?php

namespace App\Http\Controllers\Doctor;

use App\Models\City;
use App\Models\DoctorProfile;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    public function profile(){

        $departments=Department::where('status','on')->get();
        $countries=Country::where('status','active')->get();
        $cities=City::all();
        $states=State::all();
        $doctor_profile=DoctorProfile::where('user_id', Auth::id())->first();

        return view('doctor.doctor_profile', compact('departments', 'countries', 'cities', 'states', 'doctor_profile'));
    }
    public function getCity($id){
        $cities=City::where('country_id',$id)->get();
        return response()->json($cities);
    }
    public function getState($id){
        $states=State::where('city_id',$id)->get();
        return response()->json($states);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:10',
            'blood_group' => 'nullable|string|max:5',
            'department' => 'nullable|exists:departments,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $user=User::findOrFail($id);
        $data=[
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'department_id' => $request->department,
            'birthday' => $request->birthday,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'country_id' => $request->country,
            'address_line_one' => $request->address_line_one,
            'postal_code' => $request->postal_code,
            'biography' => $request->biography,
        ];
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $fName = time().'.'.$file->getClientOriginalExtension();
            $path=$file->move(public_path('uploads/doctors'), $fName);

            if($user->photo && file_exists(public_path('uploads/doctors/'.$user->photo))){
                unlink(public_path('uploads/doctors/'.$user->photo));
            }
           $data['photo'] = 'uploads/doctors/'.$fName;
        }

        $user->update($data);
        $notification = [
            'message' => 'Profile updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('doctor.profile')->with($notification);

    }

    public function DoctorProfileUpdate(Request $request, $id){

        // return $request->clinic_name;

        $doctorProfile = DoctorProfile::where('user_id', $id)->first();
        $name=json_encode($request->clinic_name);
        $address=json_encode($request->clinic_address);
        if($doctorProfile){
            $doctorProfile->update([
                'clinic_name' => $name,
                'clinic_address' => $address,
            ]);
        }else{
            DoctorProfile::create([
                'user_id' => $id,
                'clinic_name' => $name,
                'clinic_address' => $address,
            ]);
        }
    }
}
