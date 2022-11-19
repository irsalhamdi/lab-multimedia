<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Research;
use Illuminate\Http\Request;
use App\Models\ResearchResult;
use App\Http\Controllers\Controller;
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
                'category' => $request->category,
                'description' => $request->description,
                'dosen' => $request->dosen,
                'image' => $url
            ]);
    
            return redirect()->route('mahasiswa.penelitian.individu')->with('complete', 'Pendaftaran penelitian berhasil, kami akan segera menghubungi anda !');
        }
    }

    public function list()
    {   
        $researchs = Research::where('user_id', Auth::user()->id)->filter(request(['search']))->paginate(3)->withQueryString();
        return view('user.research.index', compact('researchs'));
    }

    public function information($id)
    {
        $research = Research::findOrFail($id);
        return view('user.research.information', compact('research'));
    }

    public function result($id)
    {
        $research = Research::findOrFail($id);
        $result = ResearchResult::where('research_id', $research->id)->first();

        return view('user.research.result', compact('research', 'result'));
    }

    public function resultSubmit(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:pdf'
        ], [
            'file.mimes' => 'tipe file pdf',
        ]);

        $research = Research::findOrFail($id);
        $result = ResearchResult::where('research_id', $research->id)->first();
        if($result){

            if(file_exists(public_path('upload/research/result/'.$result->file))) {
                @unlink('upload/research/result/'.$result->file);
            }            

            $file = $request->file('file');
            $destinationPath = 'upload/research/result';
            $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$name);

            ResearchResult::findOrFail($result->id)->update([
                'file' => $name,
            ]);
    
            $notification = array(
                'message' => 'Hasil penelitian berhasil diupdate !',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }

        $file = $request->file('file');
        $destinationPath = 'upload/research/result';
        $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath,$name);

        ResearchResult::create([
            'research_id' => $research->id,
            'file' => $name,
        ]);
        
        $notification = array(
            'message' => 'Hasil penelitian berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
