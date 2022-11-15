<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{   
    public function enroll(Request $request)
    {   
        $user = User::where(['nim' => $request->nim, 'email' => $request->email])->first();

        if(empty($user)){
            $notification = [
                'message' => 'Data anda belum terdaftar di sistem kami, silahkan daftarkan akun terlebih dahulu !',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $request->validate([
            'name' => ['min:3'],
            'nim' => ['min:10'],
            'phone' => ['min:10'],
            'title' => ['min:5'],
            'description' => ['min:20'],
            'dosen' => ['min:5'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'nim.min' => 'NIM harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'title.min' => 'Tema penelitien harus minimal 10 karakter',
            'description.min' => 'Deskripsi penelitian harus minimal 10 karakter',
            'dosen.min' => 'Nama Dosen penelitian harus minimal 5 karakter',
        ]);

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/research'),$fileName);
            $url = 'upload/research/' . $fileName;

            Research::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'dosen' => $request->dosen,
                'image' => $url
            ]);
    
            return redirect()->route('mahasiswa.penelitian.individu')->with('complete', 'Pendaftaran penelitian berhasil, kami akan segera menghubungi anda !');
        }
    }

    public function list()
    {   
        $researchs = Research::where('user_id', Auth::user()->id)->get();
        return view('user.research.index', compact('researchs'));
    }
}
