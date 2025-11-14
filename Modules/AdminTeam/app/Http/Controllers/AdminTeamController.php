<?php

namespace Modules\AdminTeam\App\Http\Controllers;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mollie\Api\Resources\Permission;
use Modules\AdminTeam\App\Models\AdminRole;
use Modules\AdminTeam\App\Models\AdminTeamPermissionList;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminteam::index');
    }

    public function role_list(){
        $roles=AdminRole::with('permissions')->get();
        return view('adminteam::role_list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions=AdminTeamPermissionList::where('is_group',1)->with(['children' => function($q){
            $q->where('is_group',0);
        }])->get();

        // return $permissions;


        return view('adminteam::create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:admin_roles,name',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:admin_team_permission_lists,id',
        ]);
        $name= strtolower(str_replace(' ','_',$request->name));
        $adminRole = AdminRole::create([
            'name' => $name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'status' => $request->status,
            'is_system_role' => false,
        ]);
        // $adminRole->permissions()->sync($request->permissions);


        if ($request->has('permissions')) {
            $permissions = [];

            // Add group permissions
            if (isset($request->permissions['groups'])) {
                $permissions = array_merge($permissions, $request->permissions['groups']);
            }

            // Add child permissions
            if (isset($request->permissions['children'])) {
                $permissions = array_merge($permissions, $request->permissions['children']);
            }

            // Remove duplicates and assign
            $permissions = array_unique($permissions);
            $adminRole->permissions()->attach($permissions);
        }

        $notification = array(
            'message' => 'Role created successfully.',
            'alert-type' => 'success'
        );
        // return back()->with($notification);
        return redirect()->route('adminteam.roles.list')->with('success', 'Role created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('adminteam::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminteam::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}



    public function team_list(Request $request)
    {
        $admins=Admin::where('super_admin',0)->get();
        return view('adminteam::team.teamlist', compact('admins'));
    }

    public function add_roll($id){
        $admin=Admin::findOrFail($id);
        $roles=AdminRole::where('is_system_role',0)->get();
        $admin_roles=$admin->adminroles->pluck('id')->toArray();
        // return $admin_roles;
        return view('adminteam::edit', compact('admin','roles','admin_roles'));
    }

    public function admin_team_update(Request $request, $id){
        $admin=Admin::findOrFail($id);

        $request->validate([
            'role_id' => 'required|array',
            'role_id.*' => 'exists:admin_roles,id',
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->name,
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

        $admin->update($data);

        $admin->adminroles()->sync($request->role_id);
        return redirect()->route('adminteam.list')->with('success', 'Admin roles updated successfully.');
    }

}
