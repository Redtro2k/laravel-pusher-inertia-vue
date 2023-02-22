<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function post(Request $request){
        $message = Message::create([
            'user_id' => auth()->user()->id,
            'body' => $request->get('message')
        ]);
        //load a event that you created to send from the pusherjs
       event(new MessagePosted(auth()->user(), $message->body));
    }
}
