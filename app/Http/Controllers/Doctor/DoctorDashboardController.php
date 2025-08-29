<?php

namespace App\Http\Controllers\Doctor;

use Str;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Refund;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\StripePayment;
use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function dashboard(){
        if(!Auth::check()){
            return redirect()->route('user.login');
        }

        $apportments = Appointment::where('doctor_id',Auth::user()->id)->whereDate('appointment_date','!=',Carbon::now()->format('Y-m-d'))->with('user')->orderBy('appointment_date','desc')->paginate(10);

        $appointments_today = Appointment::where('doctor_id',Auth::user()->id)->whereDate('appointment_date','=',Carbon::today())->with('user')->orderBy('appointment_date','desc')->paginate(10);


        // return $appointments_today;
        $today_patient= Appointment::where('doctor_id',Auth::user()->id)->where('appointment_date',date('Y-m-d'))->count();
        $total_appointment= Appointment::where('doctor_id',Auth::user()->id)->count();


        return view('doctor.doctor_dashboard',compact('apportments','today_patient','total_appointment','appointments_today'));
    }

    public function appointmentStatus(Request $request,$id){
        $apportment=Appointment::findOrFail($id);


        if ($apportment) {
            $today = Carbon::today();

            if (Carbon::parse($apportment->appointment_date)->lt($today)) {
                $apportment->status = "expired";
            } else {
                if ($apportment->status == "pending") {
                    $apportment->status = "approved";
                } elseif ($apportment->status == "approved") {
                    $apportment->status = "completed";
                }
            }

            $apportment->save();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Status updated successfully.',
            ]);
        }
    }

    public function appointmentCancel($id){
        $appointment=Appointment::findOrFail($id);
        $stripe=StripePayment::first();
        Stripe::setApiKey($stripe->stripe_secret_key);
        // return $stripe;

        try{
            $refund = \Stripe\Refund::create([
                'charge' => $appointment->charge_id
            ]);
            // return $refund;

            RefundRequest::create([
                'charge_id' => $appointment->charge_id,
                'appointment_id'=>$id,
                'doctor_id'=>$appointment->doctor_id,
                'user_id'=>$appointment->user_id,
                'status'=>'refunded',
            ]);


            $appointment->status = "cancelled";
            $appointment->payment_status = 2; // refunded
            $appointment->save();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Appointment cancelled & refunded successfully.',
            ]);

        }catch(\Exception $e){
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => 'Refund failed: ' . $e->getMessage(),
            ]);
        }
    }
}
