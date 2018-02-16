<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\MessageRoom;
use Broadcast;
use Auth;

class MessageController extends Controller
{   
    public function index ()
    {  
        $rooms = MessageRoom::where(['message_rooms.user_one' => Auth::id()])

        ->orWhere(['message_rooms.user_two' => Auth::id()])->get();

        return view('messages.chat-room', compact('rooms'));
    }

    public function countUnseen ()
    {
        $unseen = Message::where(['message_to' => Auth::id(), 'status' => 'unseen'])

        ->count();

        return $unseen;
    }

    public function countUnseenUser ($id)
    {
       return  Message::where(['message_to' => Auth::id() , 'user_id' => $id, 'status' => 'unseen'])
       
       ->count();
    }

    public function show ($id)
    {  
        
        $rooms = MessageRoom::where(['message_rooms.user_one' => Auth::id()])

        ->orWhere(['message_rooms.user_two' => Auth::id()])->get();
        
        $roomContents = MessageRoom::join('messages','messages.room_id','=','message_rooms.id')
        
        ->whereRaw(" user_one = '". Auth::id() ."' AND user_two = '". $id ."' OR user_one = '". $id ."' AND user_two = '". Auth::id() ."' ")
            
        ->get();

        Message::where(['message_to' => Auth::id() , 'user_id' => $id, 'status' => 'unseen'])

        ->update(['status' => 'seen']);

        return view('messages.chat-content', compact('rooms','roomContents','id'));
    }

    public function fetchMessages()
    {
      return Message::with('user')->get();
    }
    
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
               
        broadcast(new \App\Events\MessageSent($user, $message))->toOthers();
    
        return ['status' => 'Message Sent!'];
    }

    public function composeMessage(Request $request)
    {
        
    }

    public function modalMsg ( Request $req )
    {
        $seller = $req->input('sellerId');
        $body = $req->input('body');

        $buyer = Auth::User();

        $validateRoom = MessageRoom::whereRaw(" user_one = '". Auth::id() ."' AND user_two = '". $seller ."' OR user_one = '". $seller ."' AND user_two = '". Auth::id() ."' ")
        ->first();

        if (count($validateRoom) <= 0)
        {
            $room =  MessageRoom::create(['user_one' => Auth::id(), 'user_two' => $seller]);

            $buyer->messages()->create([
                'room_id' => $room->id,
                'message_to' => $seller,
                'status' => 'unseen',
                'message' => $body
            ]);
        }
        else if ( count($validateRoom) > 0 )
        {
            $buyer->messages()->create([
                'room_id' => $validateRoom->id,
                'message_to' => $seller,
                'status' => 'unseen',
                'message' => $body
            ]);
        }
        
        return "Message Sent";
    }
}