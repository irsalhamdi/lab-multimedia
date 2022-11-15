<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Research;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResearchReplyMail;
use Illuminate\Support\Facades\Mail;

class AdminResearchController extends Controller
{
    public function index()
    {
        $researchs = Research::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.research.index', compact('researchs'));
    }

    public function show($id)
    {
        $research = Research::findOrFail($id);
        return view('admin.research.detail', compact('research'));
    }

    public function acc(Request $request ,$id)
    {   
        Research::findOrFail($id)->update([
            'status' => 1,
            'information' => $request->information
        ]);

        $research = Research::findOrFail($id);
        $user = User::where('id', $research->user_id)->first();

        $data = [
            'title' => $research->title,
            'link' => 'http://127.0.0.1:8000/mahasiswa/penelitian',
            'email' => $user->name,
        ];

        Mail::to($user->email)->send(new ResearchReplyMail($data));

        $notification = [
            'message' => 'Penelitian berhasil dikonfirmasi !',
            'alert-type' => 'info',
        ];
        return redirect()->route('admin.research')->with($notification);
    }
}
