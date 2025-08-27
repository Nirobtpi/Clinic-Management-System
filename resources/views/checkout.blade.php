@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Checkout" />
@endsection
@section('content')
@php
$user=auth()->user();
@endphp
<div class="content" style="transform: none; min-height: 149px;">
    <div class="container" style="transform: none;">

        <div class="row" style="transform: none;">
            <div class="col-md-7 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Checkout Form -->
                        {{-- <form action="{{ route('stripe.post') }}" data-cc-on-file="false" method="POST"
                        id="payment-form" data-stripe-publishable-key="{{ $stripe?->stripe_key }}">
                        @csrf
                        <div class="payment-widget">
                            <h4 class="card-title">Payment Method</h4>

                            <!-- Credit Card Payment -->
                            <div class="payment-list">
                                <label class="payment-radio credit-card-option">
                                    <input type="radio" name="radio" checked="">
                                    <span class="checkmark"></span>
                                    Credit card
                                </label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group card-label">
                                            <label for="card_number">Card Number</label>
                                            <input class="form-control" name="card_number" id="card_number"
                                                placeholder="1234  5678  9876  5432" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group card-label">
                                            <label for="expiry_month">Expiry Month</label>
                                            <input class="form-control" name="expiry_month" id="expiry_month"
                                                placeholder="MM" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group card-label">
                                            <label for="expiry_year">Expiry Year</label>
                                            <input class="form-control" name="expiry_year" id="expiry_year"
                                                placeholder="YY" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group card-label">
                                            <label for="cvv">CVV</label>
                                            <input class="form-control" name="cvv" id="cvv" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="amount" value="{{ request()->get('fee') +10 }}">
                            <div id="card-element" class="form-control p-3"></div>
                            <!-- /Credit Card Payment -->

                            <!-- Submit Section -->
                            <div class="submit-section mt-4">
                                <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
                            </div>
                            <!-- /Submit Section -->

                        </div>
                        </form> --}}

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
                                <input type="hidden" name="amount" value="{{ request()->get('fee') + 10 }}">
                                <input type="hidden" name="stripeToken" id="stripeToken">
                                <input type="hidden" name="date" value="{{ request()->get('date') }}">
                                <input type="hidden" name="time" value="{{ request()->get('time') }}">
                                <input type="hidden" name="patient_name" value="{{ request()->get('patient_name') }}">
                                <input type="hidden" name="doctor_id" value="{{ request()->get('doctor_id') }}">
                                <input type="hidden" name="clicnic" value="{{ request()->get('clicnic') }}">

                                <!-- Submit -->
                                <div class="submit-section mt-3">
                                    <button type="button" id="payment-button" class="btn btn-primary">Confirm and Pay</button>
                                </div>
                            </div>
                        </form>
                        <!-- /Checkout Form -->

                    </div>
                </div>

            </div>

            <div class="col-md-5 col-lg-4 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <!-- Booking Summary -->

                <!-- /Booking Summary -->

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 1165px; top: 0px;">
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Summary</h4>
                        </div>
                        <div class="card-body">

                            <!-- Booking Doctor Info -->
                            <div class="booking-doc-info">
                                <a href="doctor-profile.html" class="booking-doc-img">
                                    <img src="{{ asset($doctor?->photo ?? 'frontend/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                        alt="User Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="doctor-profile.html">{{ $doctor?->name }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
                                    <div class="clinic-details">
                                        <p class="doc-location"><i
                                                class="fas fa-map-marker-alt"></i>{{ $doctor?->address_line_one }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Booking Doctor Info -->

                            <div class="booking-summary">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Date <span>{{ date('d M Y',strtotime(request()->get('date'))) }}</span></li>
                                        <li>Time
                                            <span>{{ \Carbon\Carbon::parse(request()->get('time'))->format('g:i A') }}</span>
                                        </li>
                                    </ul>
                                    <ul class="booking-fee">
                                        <li>Consulting Fee <span>${{ request()->get('fee') }}</span></li>
                                        <li>Booking Fee <span>$10</span></li>
                                        {{-- <li>Video Call <span>$50</span></li> --}}
                                    </ul>
                                    <div class="booking-total">
                                        <ul class="booking-total-list">
                                            <li>
                                                <span>Total</span>
                                                <span class="total-cost">${{ request()->get('fee')+10 }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-sensor"
                        style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div class="resize-sensor-expand"
                            style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div
                                style="position: absolute; left: 0px; top: 0px; transition: all; width: 390px; height: 758px;">
                            </div>
                        </div>
                        <div class="resize-sensor-shrink"
                            style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
                            </div>
                        </div>
                    </div>
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

// custom card code
// $(function () {
//     var stripe = Stripe("{{ $stripe->stripe_key }}");

//     $('#payment-button').on('click', function (e) {
//         e.preventDefault();

//         var cardData = {
//             number: $('#card-number').val(),
//             exp_month: $('#card-exp-month').val(),
//             exp_year: $('#card-exp-year').val(),
//             cvc: $('#card-cvc').val(),
//         };

//         stripe.createToken('card', cardData).then(function (result) {
//             if (result.token) {
//                 $('#stripeToken').val(result.token.id);
//                 $('#payment-form').submit();
//             } else {
//                 toastr.error(result.error.message);
//             }
//         });
//     });
// });

</script>


@endpush
