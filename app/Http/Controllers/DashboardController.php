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

        $doctor=User::where('id', $id)->where('role', 'doctor')->with('scheduleTimings','profile','socialMedia','department','doctorReviews.user')->first();
        $clicnic=json_decode($doctor->profile->clinic_id ?? '[]', true);
        $clicnics=Clinic::whereIn('id',$clicnic)->get();
        $scheduleTimings=ScheduleTiming::where('user_id', $id)->get();
        // $reviews=User::where('id', $id)->with('doctorReviews','reviews.user')->get();
        // $get_user

        // return $doctor;

        $today = Carbon::now()->format('l'); // Sunday, Monday etc.
        $currentTime = Carbon::now()->format('H:i');

        $hours = ScheduleTiming::where('user_id', $id)->get()->keyBy('day_of_week');
        $todayHours = $hours[$today] ?? null;
        $isOpen = false;
        $open=false;

        if ($todayHours && $todayHours->is_active == 1 && !empty($todayHours->start_time)) {
            $endTimes = json_decode($todayHours->end_time, true) ?? [];
            $startTimes = json_decode($todayHours->start_time, true) ?? [];

            foreach ($startTimes as $i => $start) {
                $startTime = Carbon::createFromFormat('H:i', $start);
                $endTime   = isset($endTimes[$i]) ? Carbon::createFromFormat('H:i', $endTimes[$i]) : null;
                $now = Carbon::now();

                if ($endTime && $now->between($startTime, $endTime)) {
                    $isOpen = true;
                    break;
                }
                if($now->lessThan($startTime)){
                    $open = true;
                    break;
                }
            }
        }


        return view('doctor_profile', compact('doctor','clicnics','scheduleTimings','isOpen','todayHours','open'));
    }
}
