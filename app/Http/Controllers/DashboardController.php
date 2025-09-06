<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Nette\Utils\Json;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\StripePayment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor\ScheduleTiming;
use Illuminate\Contracts\Session\Session;
use Stripe\Stripe;

class DashboardController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $doctors=User::where('role', 'doctor')->with('scheduleTimings','profile','reviews.doctor')->get();
        // return base_path();

        return view('home', compact('departments','doctors'));
    }
    public function doctorProfileView($id){

        $doctor=User::where('id', $id)->where('role', 'doctor')->with('scheduleTimings','profile','socialMedia','department','doctorReviews.user')->first();
        $clicnic=json_decode($doctor->profile->clinic_id ?? '[]', true);
        $clicnics=Clinic::whereIn('id',$clicnic)->get();
        $scheduleTimings=ScheduleTiming::where('user_id', $id)->get();

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

    public function booking($id){
        $doctor=User::where('id', $id)->where('role', 'doctor')->with('scheduleTimings','profile','doctorReviews')->first();
        // return $doctor;
        $scheduleTimings=ScheduleTiming::where('user_id', $id)->get();
        $clinic=json_decode($doctor->profile->clinic_id ?? '[]', true);
        $clinics=Clinic::whereIn('id',$clinic)->get();

        $start_time=[];
        $end_time=[];
        foreach ($scheduleTimings as $scheduleTiming) {
           $start_time= $scheduleTiming->start_time = json_decode($scheduleTiming->start_time,true);
           $end_time= $scheduleTiming->end_time = json_decode($scheduleTiming->end_time,true);
        }
        // return $start_time;

        return view('booking',compact('doctor','scheduleTimings','start_time','end_time','clinics'));
    }

    public function checkDay(Request $request, $id)
    {
        $scheduleTimings = ScheduleTiming::where('user_id', $request->doctor_id)
            ->where('clinic_id', $id)
            ->where('is_active', 1)
            ->get()
            ->keyBy('day_of_week');

        $ajaxDate = Carbon::parse($request->date)->format('l');
        $scheduleTiming = $scheduleTimings[$ajaxDate] ?? null;
        $selectedDate=Carbon::parse($request->date);

        $apportment = Appointment::where('user_id', Auth::user()->id)
            ->where('appointment_date', $selectedDate->format('Y-m-d'))->where('doctor_id', $request->doctor_id)
            ->first();
        if($apportment){
            return response()->json([
                'status' => 'error',
                'message' => 'You already have an appointment on this date.',
            ]);
        }
        $timeSlots = [];

        if ($scheduleTiming && $scheduleTiming->is_active == 1) {
            $startTimes = json_decode($scheduleTiming->start_time, true) ?? [];
            $endTimes   = json_decode($scheduleTiming->end_time, true) ?? [];

            foreach ($startTimes as $i => $start) {
                $startTime = Carbon::createFromFormat('H:i', $start);
                $endTime   = isset($endTimes[$i]) ? Carbon::createFromFormat('H:i', $endTimes[$i]) : null;

                if ($selectedDate->isToday() && $startTime->lt(Carbon::now())) {
                    continue;
                }

                if ($endTime) {
                    while ($startTime < $endTime) {
                        $timeSlots[] = $startTime->format('h:i A');
                        $startTime->addMinutes(30); // slot duration
                    }
                }
            }

            return response()->json([
                'status' => 'success',
                'slots' => $timeSlots,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No schedule timings found for the selected day.',
        ]);
    }

    public function checkTime(Request $request,$id){
        $appointment = Appointment::where('doctor_id', $request->doctor_id)->where('appointment_date', $request->date)->where('appointment_time', $request->time)->first();

        if($appointment){
            return response()->json([
                'status' => 'error',
                'message' => 'This time slot is already booked.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'This time slot is available.',
        ]);
    }

    // booking create
    public function bookingStore(Request $request,$id){
        $request->validate([
            'patient_phone'=>'required|string',
            'date'=>'required|date',
            'clicnic'=>'required|integer',
            'time'=>'required|string',
            'select_patient'=>'required',
        ]);
        $doctor=User::where('id',$id)->where('role','doctor')->with('doctorReviews')->first();
        $stripe=StripePayment::first();

        $amount=$request->fee;


         $info = [
            'patient_name' => $request->patient_name ?? '',
            'patient_phone' => $request->patient_phone,
            'select_patient' => $request->select_patient,
            'fee' => $amount, // override the user-input fee
            'date' => $request->date,
            'clinic' => $request->clicnic,
            'time' => $request->time,
            'doctor_id' => $request->doctor_id,
        ];
        session()->put('info', $info);
        session()->put('doctor', $doctor);


        return redirect()->route('user.checkout');
    }

    function checkout(){

        $stripe=StripePayment::first();
        return view('checkout',compact('stripe'));
    }


}
