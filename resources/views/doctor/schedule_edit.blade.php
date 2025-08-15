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
                                <h4 class="card-title">Edit Schedule Timings</h4>
                                <div class="">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Edit Time Slots') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('schedule.update', $shedudelData->day_of_week) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" class="day" name="day">

                                            <div class="hours-info">
                                                 @foreach (json_decode($shedudelData->start_time) as $i=>$sc_time)
                                                <div class="row form-row hours-cont">
                                                    <div class="col-12 col-md-10">

                                                        <div class="row form-row">

                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Start Time</label>

                                                                    <select class="form-control" id="startTimeSelect"
                                                                        name="start_time[]">
                                                                        <option value="">Select One</option>
                                                                        @php
                                                                        $start_time=array_map(function($time){
                                                                        return date('h:i A', strtotime($time));
                                                                        }, $startTime);

                                                                        @endphp
                                                                        @foreach($start_time as $index=>$time)
                                                                        <option @if($startTime[$index]==$sc_time)
                                                                            selected @endif
                                                                            value="{{ $startTime[$index] }}">{{ $time }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>End Time</label>
                                                                    <select class="form-control" id="endTimeSelect"
                                                                        name="end_time[]">
                                                                        <option value="">Select One</option>
                                                                        @php
                                                                        $end_time=array_map(function($time){
                                                                        return date('h:i A', strtotime($time));
                                                                        }, $endTime);
                                                                        $sc_end_time=json_decode($shedudelData->end_time,true);

                                                                        @endphp
                                                                        @foreach($end_time as $index=>$time)
                                                                        <option @if($endTime[$index]==$sc_end_time[$i])
                                                                            selected @endif
                                                                            value="{{ $endTime[$index] }}">{{ $time }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="">
                                                <div class="form-group">
                                                    <label>Active</label>
                                                    <select class="form-control" name="status">
                                                        <option value="">Status Add</option>
                                                        <option @selected($shedudelData->is_active==1) value="1">On Day</option>
                                                        <option @selected($shedudelData->is_active==0) value="0">Off Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="add-more mb-3">
                                        <a href="javascript:void(0);" class="add-hours"><i
                                                class="fa fa-plus-circle"></i> Add More</a>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save
                                            Changes</button>
                                    </div>
                                    </form>
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


@push('js')
<script>
    $(document).on('click', '.get_day', function () {
            let day=$(this).data('day');
            $('.day').val(day);
    })
    $(document).ready(function () {

        $(document).on('click', '.delete_schedule', function () {
            let val = $(this).closest('.doc-slot-list').find('.time').text();
        })

        $(document).on('click', '.get_day', function () {
            let day = $(this).data('day');
            $('.day').val(day);

        })
    })

    var startTimes = @json($start_time);
    var endTimes = @json($end_time);
    var valueStartTimes = @json(array_map(function ($time) {
        return date('H:i', strtotime($time));
    }, $start_time));
    var valueEndTimes = @json(array_map(function ($time) {
        return date('H:i', strtotime($time));
    }, $end_time));
    $(".add-hours").on('click', function () {
        let startOptions = '<option value="">Select One</option>';
        startTimes.forEach((time, index) => {
            startOptions += `<option value="${valueStartTimes[index]}">${time}</option>`;
        });

        let endOptions = '<option value="">Select One</option>';
        endTimes.forEach((time, index) => {
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
