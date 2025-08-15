<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor\ScheduleTiming;

class ScheduleTimingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheduels=ScheduleTiming::where('user_id',Auth::id())->get();
        $sundayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Sunday')->where('is_active',1)->first();
        $mondayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Monday')->where('is_active',1)->first();
        $tuesdayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Tuesday')->where('is_active',1)->first();
        $thursdayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Thursday')->where('is_active',1)->first();
        $wednesdayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Wednesday')->where('is_active',1)->first();
        $fridayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Friday')->where('is_active',1)->first();
        $saturdayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Saturday')->where('is_active',1)->first();
        // $day=S

        $weekdays=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        // $startTime=['8:00','9:00','10:00','11:00','4:00','5:00','6:00','7:00'];
        $startTime = ['08:00','09:00','10:00','11:00','16:00','17:00','18:00','19:00'];

        // $endTime=['9:00','10:00','11:00','12:00','5:00','6:00','7:00','8:00'];
        $endTime = ['09:00','10:00','11:00','12:00','17:00','18:00','19:00','20:00'];

        // return $sundayData;

        return view('doctor.schedule_timings',compact('sheduels','weekdays','startTime','endTime','sundayData','mondayData','tuesdayData','thursdayData','wednesdayData','fridayData','saturdayData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        if($request->status==1){
            $request->validate([
                'start_time' => 'required|array',
                'start_time.*' => 'required|date_format:H:i',
                'end_time'   => 'required|array',
                'end_time.*' => 'required|date_format:H:i|after:start_time.*',
                'day' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            ]);
        }

        ScheduleTiming::updateOrCreate(
            [
                'user_id'=>Auth::id(),
                'day_of_week'=>$request->day,
            ],
            [
                'start_time' =>json_encode($request->start_time),
                'end_time' => json_encode($request->end_time),
                'is_active' => $request->status,
            ]
        );
        $notification = [
            'message' => 'Schedule Timing created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
    public function scheduleUpdate($day){

        $sheduels=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week',$day)->select('start_time','end_time','is_active')->first();
        return response()->json($sheduels);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $schedule_day)
    {
        $weekdays=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        $startTime = ['08:00','09:00','10:00','11:00','16:00','17:00','18:00','19:00'];
        $endTime = ['09:00','10:00','11:00','12:00','17:00','18:00','19:00','20:00'];
        $shedudelData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week',$schedule_day)->first();
         return view('doctor.schedule_edit',compact('shedudelData','weekdays','startTime','endTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $schedule_day)
    {
        $getData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week',$schedule_day)->first();

        $getData->update([
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'is_active'=>$request->status,
        ]);

        $notification = [
            'message' => 'Schedule Timing updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('schedule.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
