@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Checkout" />
@endsection
@section('content')
@php
$user=auth()->user();
$doctor=session()->get('doctor');
$session=session()->get('info');
@endphp
<div class="content" style="transform: none; min-height: 149px;">
    <div class="container" style="transform: none;">

        <div class="row" style="transform: none;">
            <div class="col-md-7 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header mb-4">
                                <ul class="booking-date">
                                    <li>Date <span>{{ date('d M Y',strtotime(request()->get('date'))) }}</span></li>
                                    <li>Time
                                        <span>{{ \Carbon\Carbon::parse(request()->get('time'))->format('g:i A') }}</span>
                                    </li>
                                </ul>
                                <ul class="booking-fee">
                                    <li>Consulting Fee <span>${{ $session['fee'] }}</span></li>
                                    <li>Booking Fee <span>$10</span></li>
                                    {{-- <li>Video Call <span>$50</span></li> --}}
                                </ul>
                        </div>
                         @if($stripe->status == 1)
                            <form id="payment-form" method="POST" action="{{ route('stripe.post') }}">
                                @csrf
                                <div class="payment-widget">
                                    <h4 class="card-title">Payment Method</h4>

                                    <!-- Stripe Card Element -->
                                    <div class="form-group">
                                        <label for="card-element">Card Details</label>
                                        <div id="card-element" class="form-control p-2"></div>
                                    </div>

                                    <!-- Error message -->

                                    <div id="card-errors" class="text-danger mt-2"></div>
                                    <!-- Hidden Amount -->
                                    <input type="hidden" name="amount" value="{{ $session['fee'] + 10 }}">
                                    <input type="hidden" name="stripeToken" id="stripeToken">
                                    <input type="hidden" name="date" value="{{ $session['date'] }}">
                                    <input type="hidden" name="time" value="{{ $session['time'] }}">
                                    <input type="hidden" name="patient_name" value="{{ $session['patient_name'] }}">
                                    <input type="hidden" name="doctor_id" value="{{ $session['doctor_id'] }}">
                                    <input type="hidden" name="clicnic" value="{{ $session['clinic'] }}">
                                    <input type="hidden" name="number_patient" value="{{ $session['select_patient'] }}">
                                    <input type="hidden" name="phone_number" value="{{ $session['patient_phone'] }}">

                                    <!-- Submit -->
                                    <div class="submit-section mt-3">
                                        <button type="button" id="payment-button" class="btn btn-primary">Confirm and Pay</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <!-- /Checkout Form -->

                    </div>
                </div>

            </div>

            <div class="col-md-5 col-lg-4 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <!-- Booking Summary -->

                <!-- /Booking Summary -->

                <div class="theiaStickySidebar">
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Getway</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- @if($stripe->status == 1)
                                <div class="col-12">
                                    <a href="#" class="btn btn-lg bg-info-light" data-toggle="modal" data-target="#appt_details">
											<img width="60px" src="{{ asset($stripe?->icon) }}" alt="">
										</a>
                                </div> --}}
                                @if($stripe->status == 1)
                                <div class="col-12">
                                    <a href="{{ route('mollie.payment',auth()->user()->id) }}" class="btn btn-lg bg-info-light">
											Mollie
										</a>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('modal')


    <div class="modal fade custom-modal" id="appt_details" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Stripe Payment Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="info-details">
                       <form method="POST" id="custom_form" action="{{ route('stripe.post') }}">
                        @csrf
                         <!-- #region -->
                         <div class="form-group">
                             <label for="card-element">Card Number</label>
                             <input type="text" id='card-number' name="card_number" class="form-control ">
                         </div>
                         <div class="row">
                           <div class="col-6">
                             <div class="form-group">
                                <label for="card-element">Expiry Month</label>
                                <input type="text" id='card-exp-month' name="expiry_date" class="form-control">
                             </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="card-element">Expiry Year</label>
                                    <input type="text" id='card-exp-year' name="expiry_date" class="form-control">
                                    <input type="hidden" id="stripeToken" name="stripeToken">
                                </div>
                            </div>
                         </div>

                         <div class="form-group">
                             <label for="card-element">CVC</label>
                             <input type="text" id='card-cvc' name="cvc" class="form-control">
                         </div>

                        <div class="form-group" id='card-errors'>
                            <div  class="alert-danger alert"></div>
                        </div>

                         <div class="form-group">
                            <button type="submit" id='payment-button' class="btn btn-primary">Pay Now</button>
                         </div>
                         <!-- #endregion -->
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

<script>
$(function() {
   var stripe=Stripe("{{ $stripe->stripe_key }}");
   var elements = stripe.elements();
   var cardElement = elements.create('card');
   cardElement.mount('#card-element');

   $('#payment-button').on('click',function(e){
       payWithStripe();
   });

   function payWithStripe(){
    stripe.createToken(cardElement).then(function(result) {
        // console.log(result.token.id);
        if(result.token){
            $('#stripeToken').val(result.token.id);
            $('#payment-form').submit();
        }else{
            toastr.error(result.error.message);
        }
    });
    }
});


</script>


@endpush
