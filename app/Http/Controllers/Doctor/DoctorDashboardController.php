<?php

namespace App\Http\Controllers\Doctor;

use Str;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Refund;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\StripePayment;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;
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
            if($appointment->payment_method == 'stripe'){

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
            }

            if($appointment->payment_method == 'mollie'){
                $payment = Mollie::api()->payments->get($appointment->transaction_id);
                $amount=$payment->amount->value * 0.85;
                $refund = $payment->refund([
                    "amount" => [
                        "currency" => $payment->amount->currency,
                        "value"    => $amount,
                    ],
                ]);

            }


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

    public function allAppointment(){
        $appointments = Appointment::where('doctor_id',Auth::user()->id)->with('user')->orderBy('appointment_date','desc')->paginate(6);
        // return $appointments;
        return view('doctor.all_appointment',compact('appointments'));
    }

    public function appointmentView($id){

        $appointment=Appointment::findOrFail($id);

        $html= view('doctor._appointment_view',compact('appointment'))->render();

        return response()->json([
            'status' => 'success',
            'html'   => $html
        ]);
    }

    public function myPatient(){
        $my_patients = Appointment::where('doctor_id',Auth::user()->id)->with('user')
        ->whereIn('id',function($query){
            $query->selectRaw('max(id) as id')
            ->from('appointments')
            ->groupBy('user_id');
        })
        ->orderBy('appointment_date','desc')
        ->paginate(10);
        // return $appointments;
        return view('doctor.my_patient',compact('my_patients'));
    }
}
