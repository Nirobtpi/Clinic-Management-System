<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|string',
        ]);
        $data=[];
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['birthday'] = $request->birth_date;
        $data['phone'] = $request->phone;
        $data['address_line_one'] = $request->address;
        $data['blood_group'] = $request->blood_group;
        $data['gender'] = $request->gender;

        $data['role'] = 'user';


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            $data['photo'] = 'uploads/users/' . $filename;
        }
        $user = User::create($data);
        $notification = [
            'message' => 'User created successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('users.index')->with($notification);

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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|string',
        ]);
        $data=[];
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['status'] = $request->has('status') ? 'active' : 'inactive';
        $data['birthday'] = $request->birth_date;
        $data['phone'] = $request->phone;
        $data['address_line_one'] = $request->address;
        $data['blood_group'] = $request->blood_group;
        $data['gender'] = $request->gender;
        $data['role'] = 'user';


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $data['photo'] = 'uploads/users/' . $filename;

        }
        $user->update($data);
        $notification = [
            'message' => 'User updated successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('users.index')->with($notification);
    }

    public function statusUpdate($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 'active' ? 'inactive' : 'active'; // Toggle status
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        // Delete photo if exists
        if ($user->photo && file_exists(public_path($user->photo))) {
            unlink(public_path($user->photo));
        }
        $user->delete();
        $notification = [
            'message' => 'User deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('users.index')->with($notification);
    }
}
