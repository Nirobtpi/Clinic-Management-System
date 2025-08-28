<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user=Auth::user();
        $appointments=Appointment::where('user_id',$user->id)->with('user','doctor','clinic')->get();
        // return $appointments;

        return view('user.user_dashboard',compact('appointments'));
    }
}
