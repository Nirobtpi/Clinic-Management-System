<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // $app=Appointment::where('user_id',Auth::user()->id)->pluck('doctor_id')->toArray();
        // return $app;
        $users = User::where('role', 'doctor')->whereHas('appointments_doctor',function($q){
            $q->where('user_id', Auth::user()->id);
        })->get();
        // return $users;

        return view('user_chat', compact('users'));
    }

    public function getMessages($user_id)
    {
        $messages = Message::where(function($q) use ($user_id){
            $q->where('sender_id', auth()->id())->where('receiver_id', $user_id);
        })->orWhere(function($q) use ($user_id){
            $q->where('sender_id', $user_id)->where('receiver_id', auth()->id());
        })->with('sender','receiver')->orderBy('created_at')->get();

        $recipient = User::find($user_id);

         return view('chat_box', compact('messages', 'recipient'))->render();

        // return $messages;
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return $message->load('sender');
    }
}
