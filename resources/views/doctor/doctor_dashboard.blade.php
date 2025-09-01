@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Dashboard" />
@endsection
@section('content')
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            @include('doctor.doctor_sidebar')

            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card dash-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget dct-border-rht">
                                            <div class="dash-widget-info">
                                                <h6>{{ __('Total Patient') }}</h6>
                                                <h3>{{ $today_patient }}</h3>
                                                <p class="text-muted">{{ __('Till Today') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget dct-border-rht">
                                            <div class="dash-widget-info">
                                                <h6>{{ __('Today Patient') }}</h6>
                                                <h3>{{ $today_patient }}</h3>
                                                <p class="text-muted">{{ date('d M, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget">
                                            <div class="dash-widget-info">
                                                <h6>{{ __('Appoinments') }}</h6>
                                                <h3>{{ $total_appointment }}</h3>
                                                <p class="text-muted">{{ date('d M, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">{{ __('Patient Appoinment') }}</h4>
                        <div class="appointment-tab">

                            <!-- Appointment Tab -->
                            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#upcoming-appointments"
                                        data-toggle="tab">{{ __('Upcoming') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#today-appointments"
                                        data-toggle="tab">{{ __('Today') }}</a>
                                </li>
                            </ul>
                            <!-- /Appointment Tab -->

                            <div class="tab-content">

                                <!-- Upcoming Appointment Tab -->
                                <div class="tab-pane show active" id="upcoming-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('Patient Name') }}</th>
                                                            <th>{{ __('Appt Date') }}</th>
                                                            <th>{{ __('Purpose') }}</th>
                                                            <th>{{ __('Type') }}</th>
                                                            <th class="text-center">{{ __('Paid Amount') }}</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($apportments->isNotEmpty())
                                                        @foreach($apportments as $apportment)
                                                            <tr>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                            class="avatar avatar-sm mr-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="{{ $apportment->user->photo ? asset($apportment->user->photo) : asset('frontend/assets/img/patients/patient.jpg')   }}"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">{{ $apportment->user->name }}
                                                                            <span>#PT0016</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td>{{ date('d M, Y', strtotime($apportment->appointment_date)) }}
                                                                    <span
                                                                        class="d-block text-info">{{ Carbon\Carbon::parse($apportment->appointment_time)->format('g:i A') }}</span>
                                                                </td>
                                                                <td>General</td>
                                                                <td>
                                                                    {{-- New Patient --}}
                                                                    @php
                                                                        $patientId = $apportment->user_id;
                                                                        $currentAppointmentDate = Carbon\Carbon::parse($apportment->appointment_date);


                                                                        $lastAppointment = \App\Models\Appointment::where('user_id', $patientId)->where('appointment_date', '<', $currentAppointmentDate)->orderBy('appointment_date', 'desc')->first();
                                                                        if (!$lastAppointment) {
                                                                            $patientType = 'New Patient';
                                                                        } else {
                                                                            $lastAppointmentDate = Carbon\Carbon::parse($lastAppointment->appointment_date);
                                                                            $newPeriodEnd = $lastAppointmentDate->copy()->addDays(30);

                                                                            if ($currentAppointmentDate < $newPeriodEnd) {

                                                                                $patientType = 'Old Patient';

                                                                            } else {
                                                                                $patientType = 'New Patient';
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    {{ $patientType }}

                                                                </td>
                                                                <td class="text-center">${{ $apportment->total_ammount }}</td>
                                                                <td class="text-right">
                                                                    <div class="table-action">
                                                                        <a data-url="{{ route('doctor.appointment.view', $apportment->id) }}" class="btn btn-sm bg-info-light appointment_view" data-toggle="modal"
                                                                            data-target="#appt_details">
                                                                            <i class="far fa-eye"></i> View
                                                                        </a>
                                                                        @if($apportment->status != 'cancelled')
                                                                            <a href="{{ $apportment->status == 'completed' ? 'javascript:void(0);' : route('doctor.appointment.status', $apportment->id) }}"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i>
                                                                                @if($apportment->status == 'approved')
                                                                                Approved
                                                                                @elseif($apportment->status == 'pending')
                                                                                Accept
                                                                                @elseif($apportment->status == 'completed')
                                                                                Close
                                                                                @endif

                                                                            </a>
                                                                        @endif
                                                                        @if($apportment->status != 'completed' && $apportment->status != 'approved')
                                                                        <a href="{{ $apportment->status == 'cancelled' ? 'javascript:void(0);' : route('doctor.appointment.cancel', $apportment->id) }}"
                                                                            class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> {{ $apportment->status == 'cancelled' ? 'Rejected' : 'Cancel' }}
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        @else
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                {{ __('No Upcoming Appointments') }}
                                                            </td>
                                                        </tr>
                                                        @endif


                                                    </tbody>

                                                </table>
                                                <div class="d-flex pr-3 mt-3">
                                                    <div class="ml-auto">
                                                        {{ $apportments->links('pagination::bootstrap-4') }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Upcoming Appointment Tab -->

                                <!-- Today Appointment Tab -->
                                <div class="tab-pane" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Patient Name</th>
                                                            <th>Appt Date</th>
                                                            <th>Purpose</th>
                                                            <th>Type</th>
                                                            <th class="text-center">Paid Amount</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                      <tbody>
                                                    @if($appointments_today->isNotEmpty())
                                                        @foreach($appointments_today as $apportment)
                                                            <tr>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href=""
                                                                            class="avatar avatar-sm mr-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="{{ $apportment->user->photo ? asset($apportment->user->photo) : asset('frontend/assets/img/patients/patient.jpg')   }}"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">{{ $apportment->user->name }}
                                                                            <span>#PT0016</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td>{{ date('d M, Y', strtotime($apportment->appointment_date)) }}
                                                                    <span
                                                                        class="d-block text-info">{{ Carbon\Carbon::parse($apportment->appointment_time)->format('g:i A') }}</span>
                                                                </td>
                                                                <td>General</td>
                                                                <td>
                                                                    {{-- New Patient --}}
                                                                    @php
                                                                        $patientId = $apportment->user_id;
                                                                        $currentAppointmentDate = Carbon\Carbon::parse($apportment->appointment_date);


                                                                        $lastAppointment = \App\Models\Appointment::where('user_id', $patientId)->where('appointment_date', '<', $currentAppointmentDate)->orderBy('appointment_date', 'desc')->first();

                                                                        if (!$lastAppointment) {
                                                                            $patientType = 'New Patient';
                                                                        } else {
                                                                            $lastAppointmentDate = Carbon\Carbon::parse($lastAppointment->appointment_date);
                                                                            $newPeriodEnd = $lastAppointmentDate->copy()->addDays(30);

                                                                            if ($currentAppointmentDate > $newPeriodEnd) {

                                                                                $patientType = 'New Patient';

                                                                            } else {
                                                                                $patientType = 'Old Patient';
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    {{ $patientType }}

                                                                </td>
                                                                <td class="text-center">${{ $apportment->total_ammount }}</td>
                                                                <td class="text-right">
                                                                    <div class="table-action">
                                                                        <a data-url="{{ route('doctor.appointment.view', $apportment->id) }}" class="btn btn-sm bg-info-light appointment_view" data-toggle="modal"
                                                                            data-target="#appt_details">
                                                                            <i class="far fa-eye"></i> View
                                                                        </a>
                                                                        @if($apportment->status != 'completed')
                                                                            <a href="{{ route('doctor.appointment.status', $apportment->id) }}"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i>
                                                                                @if($apportment->status == 'approved')
                                                                                Completed
                                                                                @elseif($apportment->status == 'pending')
                                                                                Accept
                                                                                @elseif($apportment->status == 'completed')
                                                                                Close
                                                                                @endif
                                                                            </a>
                                                                        @endif
                                                                        @if($apportment->status != 'completed' && $apportment->status != 'approved')
                                                                        <a href="{{ $apportment->status == 'cancelled' ? 'javascript:void(0);' : route('doctor.appointment.cancel', $apportment->id) }}"
                                                                            class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> {{ $apportment->status == 'cancelled' ? 'Rejected' : 'Cancel' }}
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        @else
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                {{ __('No Upcoming Appointments') }}
                                                            </td>
                                                        </tr>
                                                        @endif


                                                    </tbody>

                                                </table>
                                                <div class="d-flex pr-3 mt-3">
                                                    <div class="ml-auto">
                                                        {{ $appointments_today->links('pagination::bootstrap-4') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Today Appointment Tab -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->
@endsection

@section('modal')
<div class="modal fade custom-modal" id="appt_details" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Appointment Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
                    <div class="modal-body">
                        <div id="appt_data"></div>
                    </div>
				</div>
			</div>
</div>
@endsection
@push('js')
        <script>
            $(document).ready(function () {
                $('.appointment_view').click(function () {
                    let url = $(this).data('url');
                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function (response) {
                             if (response.status === 'success') {
                                console.log(response.html);
                                $('#appt_data').html(response.html);
                            }
                        }
                    })

                });
            })
        </script>
@endpush

