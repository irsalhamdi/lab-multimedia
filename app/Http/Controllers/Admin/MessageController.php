<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Reply;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReplyMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages =  Message::with('user')->latest()->get();
        return view('admin.message.index', compact('messages'));
    }

    public function reply($id)
    {
        $message = Message::findOrFail($id);
        $replies = Reply::with('user', 'admin')->where('message_id', $message->id)->orderBy('created_at', 'ASC')->get();
        
        return view('admin.message.reply', compact('message', 'replies'));
    }

    public function submit(Request $request ,$id)
    {
        $message = Message::findOrFail($id);
        $user = User::where('id', $message->user_id)->first();

        $data = [
            'name' => $user->name,
            'link' => 'http://127.0.0.1:8000/message',
        ];
        
        Mail::to($user->email)->send(new ReplyMail($data));
        
        Reply::create([
            'message_id' => $message->id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'message' => $request->message,
            'excerpt' => Str::limit(strip_tags($request->message), 200),
        ]);

        $notification = array(
            'message' => 'Pesan berhasil dikirim !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
