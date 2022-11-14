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
    public function research()
    {
        $user = User::where('id', Auth::user()->id)->first();

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Pendaftaran Penelitian';
        
        return view('frontend.research.index', compact('user', 'contact', 'regency', 'district', 'village', 'title'));
    }

    public function enroll(Request $request)
    {   
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
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'dosen' => $request->dosen,
                'image' => $url
            ]);

            $notification = array(
                'message' => 'Pendaftaran pelatihan berhasil !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('mahasiswa.penelitian')->with($notification);
        }
    }

    public function list()
    {   
        $researchs = Research::where('user_id', Auth::user()->id)->get();
        return view('user.research.index', compact('researchs'));
    }
}
