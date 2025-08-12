@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Schedule Timings" />
@endsection
@section('content')
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Profile Sidebar -->
            @include('doctor.doctor_sidebar')
            <!-- /Profile Sidebar -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Schedule Timings</h4>
                                <div class="profile-box">
                                    <div class="row">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Timing Slot Duration</label>
                                                <select class="select form-control">
                                                    <option>-</option>
                                                    <option>15 mins</option>
                                                    <option selected="selected">30 mins</option>
                                                    <option>45 mins</option>
                                                    <option>1 Hour</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">

                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
                                                        <ul class="nav nav-tabs nav-justified">
                                                            @foreach ($weekdays as $weekday)
                                                            <li class="nav-item">
                                                                <a class="nav-link get_day {{ $weekday == \Carbon\Carbon::now()->format('l') ? 'active' : '' }}" data-toggle="tab"
                                                                    href="#slot_{{ strtolower($weekday) }}" data-day="{{ strtolower($weekday) }}">{{ ucfirst($weekday) }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        @if($sundayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($sundayData->start_time);
                                                                    $endTimes = json_decode($sundayData->end_time);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ $time }} - {{ $endTimes[$index] }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @else
                                                        <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->
                                                    <div id="slot_monday" class="tab-pane fade show active">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#edit_time_slot"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>

                                                        <!-- Slot List -->
                                                        <div class="doc-times">
                                                            <div class="doc-slot-list">
                                                                8:00 pm - 11:30 pm
                                                                <a href="javascript:void(0)" class="delete_schedule">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- /Slot List -->

                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->
                                                    <div id="slot_wednesday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link" data-toggle="modal"
                                                                href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                Add Slot</a>
                                                        </h4>
                                                        <p class="text-muted mb-0">Not Available</p>
                                                    </div>
                                                    <!-- /Saturday Slot -->

                                                </div>
                                                <!-- /Schedule Content -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<!-- Add Time Slot Modal -->
<div class="modal fade custom-modal" id="add_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Time Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <input type="hidden" class="day" name="day">
                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control" name="start_time[]">
                                                <option value="">Select One</option>
                                                @foreach($startTime as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control" name="end_time[]">
                                                <option value="">Select One</option>
                                                @foreach($endTime as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Active</label>
                                            <select class="form-control" name="status">
                                                <option value="">Status Add</option>
                                                <option value="1">On Day</option>
                                                <option value="0">Off Day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-more mb-3">
                        <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Time Slot Modal -->

<!-- Edit Time Slot Modal -->
<div class="modal fade custom-modal" id="edit_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Time Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option selected>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option selected>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option selected>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option selected>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a
                                    href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                        </div>

                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option selected>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option selected>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a
                                    href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                        </div>

                    </div>

                    <div class="add-more mb-3">
                        <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Time Slot Modal -->
@endsection

@push('js')
<script>

    $(document).ready(function () {

        $(document).on('click', '.get_day', function () {
            let day=$(this).data('day');
            $('.day').val(day);

        })
    })

    var startTimes = @json($startTime);
    var endTimes   = @json($endTime);
    $(".add-hours").on('click', function () {
    let startOptions = '<option value="">-</option>';
    startTimes.forEach(time => {
        startOptions += `<option value="${time}">${time}</option>`;
    });

    let endOptions = '<option value="">-</option>';
    endTimes.forEach(time => {
        endOptions += `<option value="${time}">${time}</option>`;
    });

    var hourscontent = `
        <div class="row form-row hours-cont">
            <div class="col-12 col-md-10">
                <div class="row form-row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Start Time</label>
                            <select class="form-control" name="start_time[]">
                                ${startOptions}
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>End Time</label>
                            <select class="form-control" name="end_time[]">
                                ${endOptions}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2">
                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
            </div>
        </div>
    `;

    $(".hours-info").append(hourscontent);
    return false;
});



</script>
@endpush
