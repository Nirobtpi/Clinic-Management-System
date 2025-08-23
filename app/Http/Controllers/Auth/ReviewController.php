<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index(){
        $reviews = Review::where('doctor_id',Auth::user()->id)->with('user')->get();
        return view('doctor.review',compact('reviews'));
    }

    public function statusUpdate($id){
        $review=Review::findOrFail($id);
        $review->is_approved == 1 ? $review->is_approved = 0 : $review->is_approved = 1;
        $review->save();

        $notification=['message'=>'Review status updated successfully','status'=>'success'];

        return response()->json($notification);
    }

    public function reviewStore(Request $request,$id){
        $request->validate([
            'rating' => ['required'],
            'comment' => ['required'],

        ]);
        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'doctor_id' => $id
        ]);
        $notification=[
            'alert-type'=>'success',
            'message'=>'Review added successfully'
        ];

        return back()->with($notification);
    }
}
