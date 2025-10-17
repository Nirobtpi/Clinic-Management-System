<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function readAll(Request $request){

        Auth::user()->unreadNotifications->markAsRead();
        $count=Auth::user()->unreadNotifications->count();
        $message = 'All notifications marked as read successfully';
        return response()->json(['status' => 'success', 'message' => $message, 'count' => $count]);
    }
}
