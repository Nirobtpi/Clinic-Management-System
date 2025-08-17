<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class DashboardController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $doctors=User::where('role', 'doctor')->with('scheduleTimings','profile')->get();

        return view('home', compact('departments','doctors'));
    }
    public function doctorProfileView($id){

        $doctor=User::where('id', $id)->where('role', 'doctor')->with('scheduleTimings','profile','socialMedia','department')->first();
        $clicnic=json_decode($doctor->profile->clinic_id ?? '[]', true);
        $clicnics=Clinic::whereIn('id',$clicnic)->get();
    
        return view('doctor_profile', compact('doctor','clicnics'));
    }
}
