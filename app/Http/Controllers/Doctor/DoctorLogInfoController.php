<?php

namespace App\Http\Controllers\DOctor;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class DoctorLogInfoController extends Controller
{
    public function registerPage()
    {
        $departments = Department::all();
        return view('doctor.doctor_register', compact('departments'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'birthday' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|string|min:4|confirmed',
            'address' => 'required|string|max:255',
        ]);
        if(Route::has('doctor.register.post')) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'department_id' => $request->department_id,
                'password' => Hash::make($request->password),
                'address_line_one' => $request->address,
                "role"=>'doctor',
            ]);
        }
        $notification=[
            'message' => 'Doctor registered successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.login')->with($notification);
    }

    public function dashboard(){
        return view('doctor.doctor_dashboard');
    }

}
