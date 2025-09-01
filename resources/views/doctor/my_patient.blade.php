@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="My Patients" />
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Profile Sidebar -->
            @include('doctor.doctor_sidebar')
            <!-- /Profile Sidebar -->

            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row row-grid">
                    @if($my_patients->isNotEmpty())
                        @foreach($my_patients as $patient)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card widget-profile pat-widget-profile">
                                    <div class="card-body">
                                        <div class="pro-widget-content">
                                            <div class="profile-info-widget">
                                                <a href="#" class="booking-doc-img">
                                                    <img src="{{ asset($patient?->user?->photo) ?? asset('frontend/assets/img/patients/patient.jpg') }}" alt="User Image">
                                                </a>
                                                <div class="profile-det-info">
                                                    <h3><a href="#">{{ $patient?->user?->name }}</a></h3>

                                                    <div class="patient-details">
                                                        <h5><b>Patient ID :</b> P00{{ $patient?->id }}</h5>
                                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>
                                                            @if($patient?->user?->city != null)
                                                             {{ $patient?->user?->city->name }}, {{ $patient?->user?->state->name }}, {{ $patient?->user?->country->name }}
                                                            @else
                                                             {{ $patient?->user?->address_line_one }}
                                                            @endif
                                                            </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="patient-info">
                                            <ul>
                                                <li>Phone <span>{{ $patient?->user?->phone == null ? $patient?->phone_number : $patient?->user?->phone }}</span></li>
                                                <li>Age <span>{{ Carbon\Carbon::parse($patient?->user?->birthday)->age }} Years, {{ $patient?->user?->gender }}</span></li>
                                                <li>Blood Group <span>{{ $patient?->blood_group ?? 'N/A'}}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="card card-table flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title text-center">No Patient Data Found</h4>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                {{ $my_patients->links('pagination::bootstrap-4') }}

            </div>
        </div>
    </div>

</div>
@endsection
