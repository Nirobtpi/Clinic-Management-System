<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $admin = auth()->guard('admin')->user();
        if(!$admin->hasPermission('dashboard_management')){
            abort(403);
        }
        return view("admin.dashboard", compact('admin'));
    }
}
