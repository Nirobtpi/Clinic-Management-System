<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StripePayment;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function index()
    {
        $stripe=StripePayment::first();
        // $nirob= get_stripe_key('stripe_key');
        // return $nirob;
        return view('admin.paymentgetway.stripe',compact('stripe'));
    }
    public function update(Request $request){
        $data=StripePayment::first();

       if(!$data){
            StripePayment::create([
                'stripe_key'=>$request->stripe_key,
                'stripe_secret_key'=>$request->stripe_secret_key,
            ]);
            if($request->hasFile('stripe_icon')){
                $file=$request->file('stripe_icon');
                $file_name=$file->getClientOriginalName();
                $file->move(public_path('uploads/stripe'),$file_name);
               StripePayment::create([
                    'icon'=>'uploads/stripe/'.$file_name,
                ]);
            }
       }else{

            if($request->hasFile('stripe_icon')){
                $file=$request->file('stripe_icon');
                $file_name=$file->getClientOriginalName();
                $file->move(public_path('uploads/stripe'),$file_name);
                $data->update([
                    'icon'=>'uploads/stripe/'.$file_name,
                ]);
            }

            $data->update([
                'stripe_key'=>$request->stripe_key,
                'stripe_secret_key'=>$request->stripe_secret_key,
            ]);
       }

        return redirect()->route('stripe.config')->with(['message'=>'Payment getway updated successfully','alert-type'=>'success']);

    }

    public function stripe_post(Request $request){
        // dd($request->all());
        try {
            $stripe = StripePayment::first();
            Stripe::setApiKey($stripe->stripe_secret_key);

            $user=Auth::user();
            $data=session()->get('info');
            $amount=$data['fee'];

            $data=[
                'amount'=>$amount,
                'time'=>$data['time'],
                'date'=>$request->date,
                'clicnic'=>$request->clicnic,
                'doctor'=>$request->doctor_id,
                'patient_number'=>$request->number_patient,
                'phone'=>$request->phone_number,
                'fee'=>$amount,

            ];
            // return $data;

            $charge = Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment from Nirob',
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message'=>$e->getMessage(),'alert-type'=>'error']);
        }
        // dd($charge);

        if($charge->status == 'succeeded'){
            $this->create_appointment($data,$user,"stripe",'1',$charge->balance_transaction,$charge->id);
        }

        if ($charge->status == 'succeeded') {
            session()->forget('info');
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.cancel');
        }

    }

    public function success(){
        return redirect()->route('user.dashboard')->with(['message'=>'Payment successful','alert-type'=>'success']);
    }
    public function cancle(){
        return redirect()->back()->with(['message'=>'Payment Unsuccessful','alert-type'=>'error']);
    }

    protected function create_appointment(array $data, $user,$payment_method,$payment_status,$tnx_info=null,$charge_id=null)
    {
        $apportment=new Appointment();
        $apportment->user_id=$user->id;
        $apportment->app_id='#APT'.Str::random(4);
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
