<?php

namespace App\Http\Controllers\Doctor;


use Illuminate\Http\Request;
use App\Models\Doctor\SocialMedia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_media = SocialMedia::where('user_id', Auth::user()->id)->first();

        return view('doctor.social_media',compact('social_media'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        SocialMedia::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],[
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
            ]
        );
        $notification=[
            'message' => 'Social Media updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $socialMedia)
    {
        //
    }
}
