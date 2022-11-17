<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Village;
use App\Models\District;
use App\Models\Training;
use App\Models\Testimonie;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        
        return view('admin.login', compact('contact', 'regency', 'district', 'village'));
    }

    public function profile()
    {   
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function profileEdit(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
        ]);

        $id = Auth::guard('admin')->user()->id;
        Admin::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.dashboard')->with($notification);

    }

    public function password()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.password', compact('admin'));
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

        $hashed = Auth::guard('admin')->user()->password;
        if(Hash::check($request->oldpassword,$hashed)) {
            $id = Auth::guard('admin')->user()->id;
            $admin = Admin::find($id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back()->with('error', 'password sebelumnya tidak sesuai');
        }
    }

    public function image()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.image', compact('admin'));
    }

    public function imageSubmit(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if($request->file('image')){

            if (file_exists(public_path($admin->profile))) {
                @unlink($admin->profile);
            }

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin'),$fileName);
            $url = 'upload/admin/' . $fileName;

            Admin::find($admin->id)->update([
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
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            
            $notification = array(
                'message' => 'Login berhasil !',
                'alert-type' => 'success',
            );
            return redirect()->route('admin.dashboard')->with($notification);
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

        return view('admin.index', compact('news', 'release', 'training', 'users', 'dosen'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        $notification = array(
            'message' => 'Logout berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.login.form')->with($notification);
    }

    public function comment(Request $request, $id)
    {   
        News::findOrFail($id);
        Comment::create([
            'admin_id' => Auth::guard('admin')->user()->id,
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
            'admin_id' => Auth::guard('admin')->user()->id,
            'release_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function testimoniAdmin(Request $request)
    {  
        if(!Auth::guard('admin')->user()->id){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum memberikan testimoni anda !');
        }

        dd(Auth::guard('admin')->user()->id);

        Testimonie::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'testimoni' => $request->testimoni,
        ]);

        $notification = array(
            'message' => 'Terima Kasih telah memberikan testimoni anda !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}
