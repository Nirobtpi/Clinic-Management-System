<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function molliePayment()
    {
        $data=session()->get('info');
        $amount = number_format($data['fee'] * 0.85, 2, '.', '');

        try{
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $amount,
                ],
                "description" => "Order #" . rand(1000, 9999),
                "redirectUrl" => route('mollie.callback'),
            ]);

            session()->put('payment_id', $payment->id);


            return redirect($payment->getCheckoutUrl(), 303);

        }catch(\Exception $e){
            return back()->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }

    }

    public function mollieCallback(Request $request)
    {
        $data=session()->get('info');


        $paymentId = session()->get('payment_id');
    //    dd($paymentId);
        $payment   = Mollie::api()->payments->get($paymentId);
        // dd($payment);
        $user=Auth::user();
        // $data['fee']=$payment->amount->value;

        $data=[
            'fee'=>$data['fee'],
            'select_patient'=>$data['select_patient'],
            'date'=>$data['date'],
            'clicnic'=>$data['clinic'],
            'time'=>$data['time'],
            'doctor'=>$data['doctor_id'],
            'patient_number'=>$data['select_patient'],
            'phone'=>$data['patient_phone'],
        ];

        if($payment->isPaid()){
            $this->create_appointment($data,$user,'mollie','1',$paymentId,$paymentId);
        }

        if ($payment->isPaid()) {
            return redirect()->route('user.dashboard')->with(['message' => 'Payment successful', 'alert-type' => 'success']);
        } else {
            return back()->with(['message' => 'Payment Unsuccessful', 'alert-type' => 'error']);
        }
    }



    protected function create_appointment(array $data, $user,$payment_method,$payment_status,$tnx_info=null,$charge_id=null)
    {
        $apportment=new Appointment();
        $apportment->user_id=$user->id;
        $apportment->app_id='#APT'.rand(1111,9999);
        $apportment->appointment_time=Carbon::parse($data['time'])->format('H:i');
        $apportment->appointment_date=$data['date'];
        $apportment->clinic_id=$data['clicnic'];
        $apportment->doctor_id=$data['doctor'];
        $apportment->payment_method=$payment_method;
        $apportment->payment_status=$payment_status;
        $apportment->transaction_id=$tnx_info;
        $apportment->appointment_status=1;
        $apportment->patient_number=$data['patient_number'];
        $apportment->phone_number=$data['phone'];
        $apportment->fee=$data['fee'];
        $apportment->total_ammount=$data['fee'];
        $apportment->charge_id=$charge_id;
        $apportment->save();

        return $apportment;

    }
}
