<div class="modal-body">
    <ul class="info-details">
        <li>
            <div class="details-header">
                <div class="row">
                    <div class="col-md-6">
                        <span class="title">{{ $appointment->app_id }}</span>
                        <span class="text">{{ Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }} {{ Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
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
                </div>
            </div>
        </li>
        <li>
            <span class="title">Status:</span>
            <span class="text">{{ ucfirst($appointment->status) }}</span>
        </li>
        <li>
            <span class="title">Payment Method</span>
            <span class="text">{{ ucfirst($appointment->payment_method) }}</span>
        </li>
        <li>
            <span class="title">Paid Amount</span>
            <span class="text">${{ $appointment->total_ammount }}</span>
        </li>
    </ul>
</div>

