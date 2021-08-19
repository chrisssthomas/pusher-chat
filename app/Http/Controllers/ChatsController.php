<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the chat room.
     * 
     * @return view
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch a list of messages, with the user ]
     * they belong to.
     * 
     * @return Message[]
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Send a message to the chat room.
     *
     * @param Request $request
     * @return array
     */
    public function sendMessage(Request $request)
    {
      $user = Auth::user();
    
      $message = $user->messages()->create([
        'message' => $request->input('message')
      ]);
    
      broadcast(new MessageSent($user, $message))->toOthers();
    
      return ['status' => 'Message Sent!'];
    }
}
