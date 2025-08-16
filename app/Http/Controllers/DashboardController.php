<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $doctors=User::where('role', 'doctor')->with('scheduleTimings','profiles')->get();

        return view('home', compact('departments','doctors'));
    }
    public function doctorProfileView($id){
        $doctor=User::where('id', $id)->where('role', 'doctor')->with('scheduleTimings','profiles','socialMedia','department','profile')->first();
        return view('doctor_profile', compact('doctor'));
    }
}
