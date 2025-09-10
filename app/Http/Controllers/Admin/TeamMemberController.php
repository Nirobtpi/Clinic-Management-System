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
    public function index(){
        $admins=Admin::where('super_admin',0)->get();
        return view('admin.add_admin.index',compact('admins'));
    }

    public function create(){
        return view('admin.add_admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|confirmed',
            'status'=>'required',
        ]);
        $adminTeam=new Admin;
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>$request->status,
            'birthday'=>$request->birth_date,
            'address'=>$request->address
        ];
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $extension=$file->getClientOriginalExtension();
            $fileName='admin-image'."-".time().".".$extension;
            $file->move('uploads/admin/',$fileName);
            $data['photo']='uploads/admin/'.$fileName;
            // return $data['photo'];
        }

        $adminTeam->create($data);
        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Admin Created Successfully'
        );
        return redirect()->route('team.index')->with($notification);
    }

    public function edit($id){
        $admin=Admin::findOrFail($id);
        return view('admin.add_admin.edit',compact('admin'));
    }

    public function role(){
        $roles=Role::get();
        $permissions=Permission::get();
        return view('admin.role.index',compact('roles','permissions'));
    }

    public function role_add(){
        $permissions=Permission::get();
        return view('admin.role.create',compact('permissions'));
    }

    public function role_store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role=new Role;
        $role->name=strtolower($request->name);
        $role->save();

        if($request->permission){
            // $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->givePermissionTo($request->permission);
        }

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Role Created Successfully'
        );
        return redirect()->route('role.index')->with($notification);
    }

    public function role_edit($id){
        $role=Role::findOrFail($id);
        $permissions=Permission::get();
        $role_permissions=$role->permissions->pluck('id')->toArray();
        return view('admin.role.edit',compact('role','permissions','role_permissions'));
    }

    public function role_update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role=Role::findOrFail($id);
        $role->name=strtolower($request->name);
        $role->save();
        // return $request->permission;
        if ($request->permission) {
            $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Role Updated Successfully'
        );
        return redirect()->route('role.index')->with($notification);
    }

    public function role_delete($id){
        $role=Role::findOrFail($id);
        $role->delete();
        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Role Deleted Successfully'
        );
        return redirect()->route('role.index')->with($notification);
    }

    public function permission(){
        $permissions=Permission::get();
        return view('admin.permission.index',compact('permissions'));
    }

    public function permission_add(){
        return view('admin.permission.create');
    }

    public function permission_store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $permission=new Permission;
        $permission->name=strtolower($request->name);
        $permission->save();
        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Permission Created Successfully'
        );
        return redirect()->route('permission.index')->with($notification);
    }

    public function permission_edit($id){
        $permission=Permission::findOrFail($id);
        return view('admin.permission.edit',compact('permission'));
    }

    public function permission_update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $permission=Permission::findOrFail($id);
        $permission->name=strtolower($request->name);
        $permission->save();
        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Permission Updated Successfully'
        );
        return redirect()->route('permission.index')->with($notification);
    }

    public function assign_role_user($id){
        $admin=Admin::findOrFail($id);
        $roles=Role::get();
        $roles_id=$admin->roles->pluck('id')->toArray();
        return view('admin.add_admin.assign_role',compact('admin','roles','roles_id'));
    }

    public function assign_role_user_store(Request $request,$id){

        $admin=Admin::findOrFail($id);

        $roles=Role::whereIn('id', $request->role)->pluck('name')->toArray();
        // return $roles;
        $admin->syncRoles($roles);

        $notification = array(
            'alert-type'=> 'success',
            'message'=> 'Role Assign Successfully'
        );
        return redirect()->route('team.index')->with($notification);
    }

}
