<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Dosen;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Village;
use App\Models\District;
use App\Models\Participant;
use App\Models\ParticipantCommunityDedication;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(){

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        return view('dosen.login', compact('contact', 'regency', 'district', 'village'));
    }

    public function profile()
    {   
        $dosen = Auth::guard('dosen')->user();
        return view('dosen.profile.index', compact('dosen'));
    }

    public function profileEdit(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
            'nip' => ['min:10'],
            'phone' => ['min:10'],
            'address' => ['min:5'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'nip.min' => 'NIP harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'address.min' => 'Alamat harus minimal 5 karakter',
        ]);

        $id = Auth::guard('dosen')->user()->id;
        Dosen::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'success',
        );

        return redirect()->route('dosen.dashboard')->with($notification);
    }

    public function password()
    {
        $dosen = Auth::guard('dosen')->user();
        return view('dosen.profile.password', compact('dosen'));
    }

    public function passwordEdit(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ],[
            'oldpassword.required' => 'password sebelumnya harus diisi',
            'password.required' => 'password baru harus diisi',
            'password.confirmed' => 'password tidak sama',
            'password.min' => 'password minimal 8 karakter'
        ]);

        $hashed = Auth::guard('dosen')->user()->password;
        if(Hash::check($request->oldpassword,$hashed)) {
            $id = Auth::guard('dosen')->user()->id;
            $dosen = Dosen::find($id);
            $dosen->password = Hash::make($request->password);
            $dosen->save();
            Auth::logout();
            return redirect()->route('dosen.logout');
        }else{
            return redirect()->back()->with('error', 'password sebelumnya tidak sesuai');
        }
    }

    public function image()
    {
        $dosen = Auth::guard('dosen')->user();
        return view('dosen.profile.image', compact('dosen'));
    }

    public function imageSubmit(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        
        if($request->file('image')){

            if (file_exists(public_path($dosen->profile))) {
                @unlink($dosen->profile);
            }

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/dosen'),$fileName);
            $url = 'upload/dosen/' . $fileName;

            Dosen::find($dosen->id)->update([
                'profile' => $url,
            ]);

            $notification = array(
                'message' => 'Image berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function register()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        return view('dosen.register', compact('contact', 'regency', 'district', 'village'));
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255', 'unique:dosens,email'],
            'nip' => ['min:10'],
            'phone' => ['min:10'],
            'address' => ['min:5'],
            'password' => ['confirmed', 'min:8'],
            'password_confirmation' => ['required', 'min:8']
        ],[
            'name.min' => 'Nama minimal 3 karakter',
            'email.unique' => 'Email telah terdaftar',
            'nip.min' => 'NIP minimal 10 karakter',
            'phone.min' => 'No hp minimal 10 karakter',
            'address.min' => 'Alamat minimal 5 karakter',
            'password.min' => 'Password harus 8 karakter',
            'password_confirmation.min' => 'Konfirmasi password harus minimal 8 karakter'
        ]);

        $data = Dosen::where('nip', $request->nip)->first();

        if(!$data){

            $notification = array(
                'message' => 'Data anda tidak ditemukan, silahkan hubungi administrator !',
                'alert-type' => 'error',
            );

            return redirect()->route('dosen.register')->with($notification);
        }else{
            $id = $data->id;
            Dosen::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now()
            ]);
            
            $notification = array(
                'message' => 'Pendaftaran berhasil, silahkan login !',
                'alert-type' => 'success',
            );

            return redirect()->route('dosen.login.form')->with($notification);
        }
    }

    public function login(Request $request)
    {
        if(Auth::guard('dosen')->attempt(['email' => $request->email, 'password' => $request->password])){

            $notification = array(
                'message' => 'Login berhasil !',
                'alert-type' => 'success',
            );

            return redirect()->route('dosen.dashboard')->with($notification);
        }else{

            $notification = array(
                'message' => 'email atau password salah !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function dashboard()
    {
        $dedications = ParticipantCommunityDedication::where('dosen_id', Auth::guard('dosen')->user()->id)->count();
        
        return view('dosen.index', compact('dedications'));
    }

    public function logout()
    {
        Auth::guard('dosen')->logout();

        $notification = array(
            'message' => 'Logout berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('dosen.login.form')->with($notification);
    }
    
    public function comment(Request $request, $id)
    {   
        News::findOrFail($id);
        Comment::create([
            'dosen_id' => Auth::guard('dosen')->user()->id,
            'new_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function commentRelease(Request $request, $id)
    {   
        Release::findOrFail($id);
        ReleaseComment::create([
            'dosen_id' => Auth::guard('dosen')->user()->id,
            'release_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
