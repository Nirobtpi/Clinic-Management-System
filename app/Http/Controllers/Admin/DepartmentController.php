<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view("admin.departments.index", compact("departments"));
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

        $request->validate([
            "name" => "required|unique:departments,name",
            "description" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data=[];
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status ?'on':'off';

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/departments/',$filename);
            $data['logo'] = 'uploads/departments/'.$filename;
        }
        $department = Department::create($data);

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Department Created Successfully'
        );

        return redirect()->route('departments.index')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            "name" => "required|unique:departments,name,".$department->id,
            "description" => "required",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data=[];
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status ?'on':'off';

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/departments/',$filename);
            if($department->logo && file_exists(public_path('uploads/departments/'.$filename))){
                unlink(public_path('uploads/departments/'.$filename));
            }
            $data['logo'] = 'uploads/departments/'.$filename;
        }
        $department->update($data);

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Department Updated Successfully'
        );

        return redirect()->route('departments.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);

        if($department->logo && file_exists(public_path('uploads/departments/'.$department->logo))){
            unlink(public_path('uploads/departments/'.$department->logo));
        }

        $department->delete();

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Department Deleted Successfully'
        );

        return redirect()->route('departments.index')->with($notification);
    }
}
