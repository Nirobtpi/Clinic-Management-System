@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="All Appointment" />
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Profile Sidebar -->
            @include('doctor.doctor_sidebar')
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="appointments">
                    @if($appointments->isNotEmpty())
                        @foreach($appointments as $appointment)
                        <!-- Appointment List -->
                            <div class="appointment-list">
                                <div class="profile-info-widget">
                                    <a href="patient-profile.html" class="booking-doc-img">
                                        <img src="{{ asset($appointment?->user?->photo ?? 'frontend/assets/img/patients/patient1.jpg') }}" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><a href="patient-profile.html">{{ $appointment?->user?->name }}</a></h3>
                                        <div class="patient-details">
                                            <h5><i class="far fa-clock"></i>{{ Carbon\Carbon::parse($appointment?->appointment_date)->format('d M Y') }} {{ Carbon\Carbon::parse($appointment?->appointment_time)->format('h:i A') }} </h5>
                                            <h5><i class="fas fa-map-marker-alt"></i> {{ $appointment?->user?->address_line_one }}</h5>
                                            <h5><i class="fas fa-envelope"></i> {{ $appointment?->user?->email }}</h5>
                                            <h5 class="mb-0"><i class="fas fa-phone"></i> {{ $appointment?->user?->phone ?? 'N/A' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="appointment-action">
                                    <a data-url="{{ route('doctor.appointment.view', $appointment->id) }}" class="btn btn-sm bg-info-light appointment_view" data-toggle="modal"
                                        data-target="#appt_details">
                                        <i class="far fa-eye"></i> View
                                    </a>
                                @if($appointment->status != 'cancelled')
                                        <a href="{{ $appointment->status == 'completed' ? 'javascript:void(0);' : route('doctor.appointment.status', $appointment->id) }}"
                                            class="btn btn-sm bg-success-light">
                                            <i class="fas fa-check"></i>
                                            @if($appointment->status == 'approved')
                                            Approved
                                            @elseif($appointment->status == 'pending')
                                            Accept
                                            @elseif($appointment->status == 'completed')
                                            Close
                                            @endif

                                        </a>
                                @endif
                                @if($appointment->status != 'completed' && $appointment->status != 'approved')
                                    <a href="{{ $appointment->status == 'cancelled' ? 'javascript:void(0);' : route('doctor.appointment.cancel', $appointment->id) }}"
                                        class="btn btn-sm bg-danger-light">
                                        <i class="fas fa-times"></i> {{ $appointment->status == 'cancelled' ? 'Rejected' : 'Cancel' }}
                                    </a>
                                @endif
                                </div>
                            </div>
                        <!-- /Appointment List -->
                        @endforeach
                    @else
                    <h5 class="text-center">No Appointment Found</h5>
                    @endif
                    {{ $appointments->links('pagination::bootstrap-4') }}
                </div>
            </div>


        </div>
    </div>

</div>
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
