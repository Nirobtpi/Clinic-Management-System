<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // $app=Appointment::where('user_id',Auth::user()->id)->pluck('doctor_id')->toArray();
        // return $app;
        $users = User::whereHas('appointments_doctor',function($q){
            $q->where('user_id', Auth::user()->id);
        })->orWhereHas('appointments',function($q){
            $q->where('doctor_id', Auth::user()->id);
        })
        ->get();

        // return $users;

        return view('user_chat', compact('users'));
    }

    public function getMessages($user_id)
    {
        // $messages = Message::where(function($q) use ($user_id){
        //     $q->where('sender_id', auth()->id())->where('receiver_id', $user_id);
        // })->orWhere(function($q) use ($user_id){
        //     $q->where('sender_id', $user_id)->where('receiver_id', auth()->id());
        // })->with('sender','receiver')->orderBy('created_at')->get();
        // return $messages;

        $auth_id = auth()->id();

        $messages = Message::where(function($q) use ($user_id, $auth_id){
            $q->where('sender_id', $auth_id)
            ->where('receiver_id', $user_id);
        })
        ->orWhere(function($q) use ($user_id, $auth_id){
            $q->where('sender_id', $user_id)
            ->where('receiver_id', $auth_id);
        })
        ->with('sender','receiver')
        ->latest()  // created_at desc
        ->take(10)
        ->get()
        ->sortBy('created_at'); // chronological order


        $recipient = User::find($user_id);

         return view('chat_box', compact('messages', 'recipient'))->render();

        // return $messages;
    }

    public function sendMessage(Request $request)
    {
        // return response()->json([$request->all()]);
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }


    // public function sendMessage(Request $request)
    // {
    //     $messages = Message::create([
    //         'sender_id' => auth()->id(),
    //         'receiver_id' => $request->receiver_id,
    //         'message' => $request->message
    //     ]);

    //     broadcast(new MessageSent($messages))->toOthers();

    //     $recipient = User::find($request->receiver_id);

    //     return view('chat_box', compact('messages', 'recipient'))->render();
    // }
}
