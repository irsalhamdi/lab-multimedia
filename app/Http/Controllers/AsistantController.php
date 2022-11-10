<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Village;
use App\Models\Asistant;
use App\Models\District;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AsistantController extends Controller
{
    public function index()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        
        return view('asistant.login', compact('contact', 'regency', 'district', 'village'));
    }

    public function profile()
    {   
        $asistant = Auth::guard('asistant')->user();
        return view('asistant.profile.index', compact('asistant'));
    }

    public function profileEdit(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
        ]);

        $id = Auth::guard('asistant')->user()->id;
        Asistant::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.dashboard')->with($notification);

    }

    public function password()
    {
        $asistant = Auth::guard('asistant')->user();
        return view('asistant.profile.password', compact('asistant'));
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

        $hashed = Auth::guard('asistant')->user()->password;
        if(Hash::check($request->oldpassword,$hashed)) {
            $id = Auth::guard('asistant')->user()->id;
            $asistant = Asistant::find($id);
            $asistant->password = Hash::make($request->password);
            $asistant->save();
            Auth::logout();
            return redirect()->route('asistant.logout');
        }else{
            return redirect()->back()->with('error', 'password sebelumnya tidak sesuai');
        }
    }

    public function image()
    {
        $asistant = Auth::guard('asistant')->user();
        return view('asistant.profile.image', compact('asistant'));
    }

    public function imageSubmit(Request $request)
    {
        $asistant = Auth::guard('asistant')->user();
        
        if($request->file('image')){

            if (file_exists(public_path($asistant->profile))) {
                @unlink($asistant->profile);
            }

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/asistant'),$fileName);
            $url = 'upload/asistant/' . $fileName;

            Asistant::find($asistant->id)->update([
                'profile' => $url,
            ]);

            $notification = array(
                'message' => 'Image berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function login(Request $request)
    {
        if(Auth::guard('asistant')->attempt(['email' => $request->email, 'password' => $request->password])){

            $notification = array(
                'message' => 'Login berhasil !',
                'alert-type' => 'success',
            );

            return redirect()->route('asistant.dashboard')->with($notification);
        }else{

            $notification = array(
                'message' => 'Email atau password salah !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function dashboard()
    {
        $news = News::all()->count();
        $release = Release::all()->count();
        $training = Training::all()->count();
        $users = User::all()->count();
        $dosen = Dosen::all()->count();
        
        return view('asistant.index', compact('news', 'release', 'training', 'users', 'dosen'));
    }

    public function logout()
    {
        Auth::guard('asistant')->logout();

        $notification = array(
            'message' => 'Logout berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.login.form')->with($notification);
    }

    public function comment(Request $request, $id)
    {   
        News::findOrFail($id);
        Comment::create([
            'asistant_id' => Auth::guard('asistant')->user()->id,
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
            'asistant_id' => Auth::guard('asistant')->user()->id,
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
