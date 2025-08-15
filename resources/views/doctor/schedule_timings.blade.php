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
                                                                    href="#slot_{{ strtolower($weekday) }}" data-day="{{ $weekday }}">{{ ucfirst($weekday) }}</a>
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
                                                    <div id="slot_sunday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Sunday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Sunday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Sunday')->first()->day_of_week) }}" data-day="Sunday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($sundayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($sundayData->start_time,true);
                                                                    $endTimes = json_decode($sundayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
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

                                                    <div id="slot_monday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Monday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Monday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Monday')->first()->day_of_week) }}" data-day="Monday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($mondayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($mondayData->start_time,true);
                                                                    $endTimes = json_decode($mondayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Monday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>

                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->

                                                    <div id="slot_tuesday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Tuesday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Tuesday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Tuesday')->first()->day_of_week) }}" data-day="Tuesday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($tuesdayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($tuesdayData->start_time,true);
                                                                    $endTimes = json_decode($tuesdayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Tuesday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->

                                                    <div id="slot_wednesday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Wednesday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Wednesday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Wednesday')->first()->day_of_week) }}" data-day="Wednesday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($wednesdayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($wednesdayData->start_time,true);
                                                                    $endTimes = json_decode($wednesdayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Wednesday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->

                                                    <div id="slot_thursday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Thursday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Thursday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Thursday')->first()->day_of_week) }}" data-day="Wednesday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($thursdayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($thursdayData->start_time,true);
                                                                    $endTimes = json_decode($thursdayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Thursday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Friday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Friday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Friday')->first()->day_of_week) }}" data-day="Wednesday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($fridayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($fridayData->start_time,true);
                                                                    $endTimes = json_decode($fridayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Friday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                     <div id="slot_saturday" class="tab-pane fade {{ Carbon\Carbon::now()->format('l') == 'Saturday' ? 'show active' : '' }}">
                                                        @if($sheduels->where('day_of_week','Saturday')->first())
                                                            <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <a class="edit-link updateInfo"
                                                                href="{{ route('schedule.edit', $sheduels->where('day_of_week','Saturday')->first()->day_of_week) }}" data-day="Wednesday"><i
                                                                    class="fa fa-edit mr-1"></i>Edit</a>
                                                        </h4>
                                                         @else
                                                         <h4 class="card-title d-flex justify-content-between">
                                                                <span>Time Slots</span>
                                                                <a class="edit-link"  data-toggle="modal"
                                                                    href="#add_time_slot"><i class="fa fa-plus-circle"></i>
                                                                    Add Slot</a>
                                                            </h4>
                                                        @endif
                                                        @if($saturdayData)
                                                         <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @php
                                                                    $times = json_decode($saturdayData->start_time,true);
                                                                    $endTimes = json_decode($saturdayData->end_time,true);
                                                                    // print_r($times);
                                                                @endphp
                                                                    @foreach($times as $index=>$time)
                                                                        <div class="doc-slot-list">
                                                                            {{ date('h:i A', strtotime($time)) }} - {{ date('h:i A', strtotime($endTimes[$index])) }}
                                                                            <a href="javascript:void(0)" class="delete_schedule">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                            </div>
                                                        <!-- /Slot List -->
                                                        @elseif($sheduels->where('day_of_week','Saturday')->where('is_active',0)->first())
                                                            <p class="text-muted mb-0">Today Is Off Day</p>
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
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
                                                @php
                                                    $start_time=array_map(function($time){
                                                        return date('h:i A', strtotime($time));
                                                    }, $startTime);
                                                @endphp
                                                @foreach($start_time as $index=>$time)
                                                <option value="{{ $startTime[$index] }}">{{ $time }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control" name="end_time[]">
                                                <option value="">Select One</option>
                                                @php
                                                    $end_time=array_map(function($time){
                                                        return date('h:i A', strtotime($time));
                                                    }, $endTime);
                                                @endphp
                                                @foreach($end_time as $index=>$time)
                                                <option value="{{ $endTime[$index] }}">{{ $time }}</option>
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

@endsection

@push('js')
<script>

    $(document).ready(function () {

      $(document).on('click', '.delete_schedule', function () {
          let val = $(this).closest('.doc-slot-list').find('.time').text();
      })

        // $(document).on('click', '.get_day', function () {
        //     let day=$(this).data('day');
        //     $('.day').val(day);


        // })
        $(document).on('click', '.edit-link', function () {
            let day=$('.get_day').data('day');
            $('.day').val(day);


        })
    })

    var startTimes = @json($start_time);
    var endTimes   = @json($end_time);
     var valueStartTimes = @json(array_map(function($time){
        return date('H:i', strtotime($time));
    }, $start_time));
    var valueEndTimes = @json(array_map(function($time){
        return date('H:i', strtotime($time));
    }, $end_time));
    $(".add-hours").on('click', function () {
    let startOptions = '<option value="">Select One</option>';
    startTimes.forEach((time,index) => {
        startOptions += `<option value="${valueStartTimes[index]}">${time}</option>`;
    });

    let endOptions = '<option value="">Select One</option>';
    endTimes.forEach((time,index) => {
        endOptions += `<option value="${valueEndTimes[index]}">${time}</option>`;
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
