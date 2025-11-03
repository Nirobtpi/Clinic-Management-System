<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserChatController extends Controller
{
    public function userChatPage()
    {
        return view('user_chat');
    }
}
