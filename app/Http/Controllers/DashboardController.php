<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Nette\Utils\Json;
use App\Models\Clinic;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Doctor\ScheduleTiming;

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
        $scheduleTimings=ScheduleTiming::where('user_id', $id)->get();
        // return $scheduleTimings;


        $today = Carbon::now()->format('l'); // Sunday, Monday etc.
        $currentTime = Carbon::now()->format('H:i');

        $hours = ScheduleTiming::where('user_id', $id)->get()->keyBy('day_of_week');
        $todayHours = $hours[$today] ?? null;
        // return now()->format('h:i A');
        $isOpen = false;

        if ($todayHours && $todayHours->is_active == 1 && !empty($todayHours->start_time)) {
            foreach (json_decode($todayHours->start_time, true) as $i => $start) {
                $end = $todayHours->end_time[$i] ?? null;

                if ($end && $currentTime >= $start && $currentTime <= $end) {
                    $isOpen = true;
                    break;
                }
            }
        }
        // return $isOpen == true ?'Open':'Close';


        return view('doctor_profile', compact('doctor','clicnics','scheduleTimings','isOpen','todayHours'));
    }
}
