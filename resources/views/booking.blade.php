@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Booking" />
@endsection
@section('content')
@php
$user=auth()->user();
@endphp

<div class="content" style="min-height: 149px;">
    <div class="container">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <a href="doctor-profile.html" class="booking-doc-img">
                                <img src="{{ asset($doctor->photo ?? 'frontend/assets/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="{{ route('user.doctor.profile', $doctor->id) }}">{{ $doctor->name }}</a></h4>
                                <div class="rating">
                                    @php
                                        $rating = $doctor->avg_rating;
                                        $fullstar = floor($rating);
                                        $halfstar =  ($rating - $fullstar >= 0.5) ? 1 : 0;
                                        $emptyStar = 5 - $fullstar - $halfstar;
                                    @endphp
                                    @for ($i = 0; $i < $fullstar; $i++)
                                        <i class="fas fa-star filled"></i>
                                    @endfor
                                    @if ($halfstar > 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStar; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    <span class="d-inline-block average-rating">{{ number_format($doctor->avg_rating,1) }}</span>
                                </div>
                                <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $doctor->address_line_one }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Widget -->
                <div class="card booking-schedule schedule-widget">


                    <!-- Schedule Content -->
                    <div class="schedule-cont">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- Time Slot -->
                                <form action="{{ route('user.booking.store',Auth::user()->id) }}" method="post">
                                    @csrf
                                    {{-- Patient Name --}}
                                    <div class="mb-3">
                                        <label for="patient_name">Your Name</label>
                                        <input type="text" class="form-control" name="patient_name" value="{{ $user?->name }}">
                                    </div>

                                    {{-- Patient Phone --}}
                                    <div class="mb-3">
                                        <label for="patient_phone">Phone Number</label>
                                        <input type="text" class="form-control" value="{{ old('phone', $user?->phone) }}" name="patient_phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="select_patient">{{ __('Select Number Patient') }}</label>
                                        <select class="form-control" id="select_patient" name="select_patient" >
                                            <option value="" disabled selected>Select Patient</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fee">Fee</label>
                                        <input type="text" id="fee" data-price="{{ $doctor?->profile?->custom_price }}" class="form-control" value="{{ $doctor?->profile?->custom_price }}" name="fee" readonly>
                                    </div>

                                    {{-- Select Date --}}
                                    <div class="mb-3">
                                        <label for="date">Choose Date</label>
                                        <input type="date" id="check_day" class="form-control" name="date">
                                    </div>

                                    <div class="mb-3">
                                        <label for="time">Choose Clinic</label>
                                        <select class="form-control" id="clicnic" name="clicnic" >
                                            <option value=""  selected>Select Time Slot</option>
                                            @foreach ($clinics as $clicnic)
                                                <option value="{{ $clicnic->id }}">{{ $clicnic->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Select Time Slot --}}
                                    <div class="mb-3">
                                        <label for="time">Choose Time</label>
                                        <select class="form-control" id="time" name="time" >
                                            <option value="" disabled selected>Select Time Slot</option>
                                        </select>
                                    </div>
                                    {{-- Hidden doctor id --}}
                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                                <!-- /Time Slot -->

                            </div>
                        </div>
                    </div>
                    <!-- /Schedule Content -->

                </div>
                <!-- /Schedule Widget -->

                <!-- Submit Section -->
                    <div class="submit-section proceed-btn text-right">
                        <button type="submit" class="btn btn-primary submit-btn">Proceed to Pay</button>
                    </div>
                </form>
                <!-- /Submit Section -->

            </div>
        </div>
    </div>

</div>

@endsection
@push('js')
<script>
    $(document).ready(function () {
        $('#clicnic').on('change', function () {
            var clinicId = $(this).val();
            var doctor_id = "{{ $doctor->id }}";
            var date=$('#check_day').val();
            if (!date) {
                toastr.error('Please Select Date!');
                $('#check_day').focus();
                return;
            }
            // alert(doctor_id);
            // alert(doctor_id);
            var url = '{{ route("user.checkday", ":id") }}';
            url = url.replace(':id', clinicId);
            if (clinicId) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        date: date,
                        clinic_id: clinicId,
                        doctor_id: doctor_id
                    },
                    success: function (data) {
                        $('#time').empty();
                        $('#time').append('<option value="">Select Time</option>');

                        if (data.status === 'success' && data.slots.length > 0) {
                            $.each(data.slots, function (key, value) {
                                $('#time').append('<option value="' + value + '">' + value + '</option>');
                            });
                        } else {
                            toastr.error(data.message || 'No available slots found!');
                        }
                    }
                });
            }
        })

        $('#select_patient').on('change', function () {
            var patient = $(this).val();
            var price =$('#fee').data('price');
            var total=patient*price;
            $('#fee').val(total);
        })

        $('#time').on('change', function () {
            let date=$('#check_day').val();
            let time=$(this).val();
            let doctor_id = "{{ $doctor->id }}";
            let url = '{{ route("user.check.time", ':id') }}';
            url = url.replace(':id', doctor_id);
            if (time) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        date: date,
                        time: time,
                        doctor_id: doctor_id
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
        })
    })
</script>
@endpush
