<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::all();
        return view('admin.clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clinic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $photoName=[];
        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $fName = time().rand(100,999).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/clinic'), $fName);
                $photoName[] = 'uploads/clinic/' . $fName;
            }
        }
        Clinic::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'images' => json_encode($photoName),
        ]);
        $notification=[
            'message' => 'Clinic created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('clinics.index')->with($notification);
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
        $clinic = Clinic::findOrFail($id);
        return view('admin.clinic.edit', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clinicUpdate = Clinic::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoName = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/clinic'), $fName);
                $photoName[] = 'uploads/clinic/' . $fName;

                // Remove old images
                if (!empty($clinicUpdate->images)) {
                    $oldImages = json_decode($clinicUpdate->images, true);
                    foreach ($oldImages as $oldImage) {
                        if (file_exists(public_path($oldImage))) {
                            unlink(public_path($oldImage));
                        }
                    }
                }
            }
        }

        $clinicUpdate->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'images' => json_encode($photoName ?: json_decode($clinicUpdate->images, true)),
        ]);

        $notification = [
            'message' => 'Clinic updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('clinics.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        if (!empty($clinic->images)) {
            $oldImages = json_decode($clinic->images, true);
            foreach ($oldImages as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
        }
        $clinic->delete();
        $notification = [
            'message' => 'Clinic deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('clinics.index')->with($notification);
    }
}
