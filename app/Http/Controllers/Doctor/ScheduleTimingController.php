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
        $sundayData=ScheduleTiming::where('user_id',Auth::id())->where('day_of_week','Sunday')->first();

        $weekdays=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        // $startTime=['8:00','9:00','10:00','11:00','4:00','5:00','6:00','7:00'];
        $startTime = ['8:00 AM','9:00 AM','10:00 AM','11:00 AM','4:00 PM','5:00 PM','6:00 PM','7:00 PM'];

        // $endTime=['9:00','10:00','11:00','12:00','5:00','6:00','7:00','8:00'];
        $endTime   = ['9:00 AM','10:00 AM','11:00 AM','12:00 PM','5:00 PM','6:00 PM','7:00 PM','8:00 PM'];

        // return $sundayData;

        return view('doctor.schedule_timings',compact('sheduels','weekdays','startTime','endTime','sundayData'));
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
        $request->validate([
            'start_time.*' => 'required',
            'end_time.*' => 'required',
            'status' => 'required',
        ]);
        // return $request->start_time;
        // $sTime = array_map(function($time) {
        //     return trim(str_replace(['AM', 'PM'], '', $time));
        // }, $request->start_time);
        // return $sTime;
    //    return  Carbon::parse($sTime)->format('H:i:s');
        ScheduleTiming::create([
            'user_id'=>Auth::id(),
            'day_of_week'=>$request->day,
            'start_time' =>json_encode($request->start_time),
            'end_time' => json_encode($request->end_time),
            'is_active' => $request->status,
        ]);
        $notification = [
            'message' => 'Schedule Timing created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
