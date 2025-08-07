<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all(); // Assuming you have a Department model
        return view('admin.doctors.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'department_id' => 'required|exists:departments,id',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->routeIs('doctors.store')){
            $data=[];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['address_line_one'] = $request->address;
            $data['role'] = 'doctor';
            $data['status'] = $request->has('status') ? 'active' : 'inactive'; // Default status for new doctors
            $data['birthday'] = $request->birth_date;
            $data['department_id'] = $request->department_id;

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/doctors'), $imageName);
                $data['photo'] = 'uploads/doctors/' . $imageName;
            }

            User::create($data);
            $notification = [
                'message' => 'Doctor created successfully.',
                'alert-type' => 'success'
            ];
            return redirect()->route('doctors.index')->with($notification);
        }
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
        $doctor = User::findOrFail($id);
        $departments = Department::all(); // Assuming you have a Department model
        return view('admin.doctors.edit', compact('doctor', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'department_id' => 'required|exists:departments,id',
            'address' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $doctor = User::findOrFail($id);

        $doctor->name = $request->name;
        $doctor->last_name = $request->last_name;
        $doctor->email = $request->email;
        $doctor->address_line_one = $request->address;
        $doctor->department_id = $request->department_id;
        $doctor->status = $request->has('status') ? 'active' : 'inactive'; // Update status based on checkbox

        if($request->hasFile('photo')) {
            if ($doctor->photo && file_exists(public_path($doctor->photo))) {
                unlink(public_path($doctor->photo));
            }
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/doctors'), $imageName);
            $doctor->photo = 'uploads/doctors/' . $imageName;
        }

        $doctor->save();

        $notification = [
            'message' => 'Doctor updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('doctors.index')->with($notification);
    }

    /**
     * Update the status of the specified doctor.
     */
    public function statusUpdate(string $id){
        $doctor = User::findOrFail($id);
        $doctor->status = $doctor->status == 'active' ? 'inactive' : 'active';
        $doctor->save();
        return response()->json(['message' => 'Status updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = User::findOrFail($id);
        if ($doctor->photo && file_exists(public_path($doctor->photo))) {
            unlink(public_path($doctor->photo));
        }
        $doctor->delete();

        $notification = [
            'message' => 'Doctor deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('doctors.index')->with($notification);
    }
}
