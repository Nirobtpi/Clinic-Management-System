<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TeamMemberController extends Controller
{
    protected $guard_name = 'admin';

    // Admin list
    public function index(){
        $admins = Admin::where('super_admin',0)->get();
        return view('admin.add_admin.index', compact('admins'));
    }

    // Create admin form
    public function create(){
        return view('admin.add_admin.create');
    }

    // Store new admin
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|confirmed',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'birthday' => $request->birth_date,
            'address' => $request->address
        ];

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = 'admin-image-' . time() . '.' . $extension;
            $file->move('uploads/admin/', $fileName);
            $data['photo'] = 'uploads/admin/' . $fileName;
        }

        Admin::create($data);

        return redirect()->route('team.index')->with([
            'alert-type' => 'success',
            'message' => 'Admin Created Successfully'
        ]);
    }

    // Edit admin
    public function edit($id){
        $admin = Admin::findOrFail($id);
        return view('admin.add_admin.edit', compact('admin'));
    }

    // Role list
    public function role(){
        $roles = Role::where('guard_name', $this->guard_name)->get();
        $permissions = Permission::where('guard_name', $this->guard_name)->get();
        return view('admin.role.index', compact('roles','permissions'));
    }

    // Create role form
    public function role_add(){
        $permissions = Permission::where('guard_name', $this->guard_name)->get();
        return view('admin.role.create', compact('permissions'));
    }

    // Store role
    public function role_store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        // return $request->all();

        $role = Role::create([
            'name' => strtolower($request->name),
            'guard_name' => $this->guard_name
        ]);

        if($request->permission){
            // $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->syncPermissions($request->permission);
        }

        return redirect()->route('role.index')->with([
            'alert-type' => 'success',
            'message' => 'Role Created Successfully'
        ]);
    }

    // Edit role
    public function role_edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::where('guard_name', $this->guard_name)->get();
        $role_permissions = $role->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('role','permissions','role_permissions'));
    }

    // Update role
    public function role_update(Request $request, $id){
        $request->validate( [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);
        // return $request->all();

        $role = Role::findOrFail($id);
        $role->name = strtolower($request->name);
        $role->guard_name = $this->guard_name;
        $role->save();

        if($request->permission){
            // $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->syncPermissions($request->permission);
        }

        return redirect()->route('role.index')->with([
            'alert-type' => 'success',
            'message' => 'Role Updated Successfully'
        ]);
    }

    // Delete role
    public function role_delete($id){
        Role::findOrFail($id)->delete();

        return redirect()->route('role.index')->with([
            'alert-type' => 'success',
            'message' => 'Role Deleted Successfully'
        ]);
    }

    // Permission list
    public function permission(){
        $permissions = Permission::where('guard_name', $this->guard_name)->get();
        return view('admin.permission.index', compact('permissions'));
    }

    // Add permission form
    public function permission_add(){
        return view('admin.permission.create');
    }

    // Store permission
    public function permission_store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create([
            'name' => strtolower($request->name),
            'guard_name' => $this->guard_name
        ]);

        return redirect()->route('permission.index')->with([
            'alert-type' => 'success',
            'message' => 'Permission Created Successfully'
        ]);
    }

    // Edit permission
    public function permission_edit($id){
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
    }

    // Update permission
    public function permission_update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = strtolower($request->name);
        $permission->guard_name = $this->guard_name;
        $permission->save();

        return redirect()->route('permission.index')->with([
            'alert-type' => 'success',
            'message' => 'Permission Updated Successfully'
        ]);
    }

    // Delete permission
    public function permission_delete($id){
        Permission::findOrFail($id)->delete();

        return redirect()->route('permission.index')->with([
            'alert-type' => 'success',
            'message' => 'Permission Deleted Successfully'
        ]);
    }

    // Assign role to user form
    public function assign_role_user($id){
        $admin = Admin::findOrFail($id);
        $roles = Role::where('guard_name', $this->guard_name)->get();
        $roles_id = $admin->roles->pluck('id')->toArray();
        return view('admin.add_admin.assign_role', compact('admin','roles','roles_id'));
    }

    // Assign role to user store
    public function assign_role_user_store(Request $request, $id){
        $admin = Admin::findOrFail($id);
        $roles = Role::whereIn('id', $request->role)->pluck('name')->toArray();
        $admin->syncRoles($roles);

        return redirect()->route('team.index')->with([
            'alert-type' => 'success',
            'message' => 'Role Assigned Successfully'
        ]);
    }
}
