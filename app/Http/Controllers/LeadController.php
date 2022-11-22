<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\News;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Village;
use App\Models\District;
use App\Models\Practice;
use App\Models\Training;
use App\Models\Testimonie;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LeadController extends Controller
{
    public function index()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();
        
        return view('lead.login', compact('contact', 'regency', 'district', 'village'));
    }

    public function profile()
    {   
        $lead = Auth::guard('lead')->user();
        return view('lead.profile.index', compact('lead'));
    }

    public function profileEdit(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
        ]);

        $id = Auth::guard('lead')->user()->id;
        Lead::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'success',
        );

        return redirect()->route('lead.dashboard')->with($notification);

    }

    public function password()
    {
        $lead = Auth::guard('lead')->user();
        return view('lead.profile.password', compact('lead'));
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

        $hashed = Auth::guard('lead')->user()->password;
        if(Hash::check($request->oldpassword,$hashed)) {
            $id = Auth::guard('lead')->user()->id;
            $lead = Lead::find($id);
            $lead->password = Hash::make($request->password);
            $lead->save();
            Auth::logout();
            return redirect()->route('lead.logout');
        }else{
            return redirect()->back()->with('error', 'password sebelumnya tidak sesuai');
        }
    }

    public function image()
    {
        $lead = Auth::guard('lead')->user();
        return view('lead.profile.image', compact('lead'));
    }

    public function imageSubmit(Request $request)
    {
        $lead = Auth::guard('lead')->user();
        
        if($request->file('image')){

            if (file_exists(public_path($lead->profile))) {
                @unlink($lead->profile);
            }

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/lead'),$fileName);
            $url = 'upload/lead/' . $fileName;

            Lead::find($lead->id)->update([
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
        if(Auth::guard('lead')->attempt(['email' => $request->email, 'password' => $request->password])){

            $notification = array(
                'message' => 'Login berhasil !',
                'alert-type' => 'success',
            );

            return redirect()->route('lead.dashboard')->with($notification);
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

        return view('lead.index', compact('news', 'release', 'training', 'users', 'dosen'));
    }

    public function logout()
    {
        Auth::guard('lead')->logout();

        $notification = array(
            'message' => 'Logout berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('lead.login.form')->with($notification);
    }

    public function comment(Request $request, $id)
    {   
        News::findOrFail($id);
        Comment::create([
            'lead_id' => Auth::guard('lead')->user()->id,
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
            'lead_id' => Auth::guard('lead')->user()->id,
            'release_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function testimoniLead(Request $request)
    {   
        if(!Auth::guard('lead')->user()->id){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum memberikan testimoni anda !');
        }

        Testimonie::create([
            'lead_id' => Auth::guard('lead')->user()->id,
            'testimoni' => $request->testimoni,
        ]);

        $notification = array(
            'message' => 'Terima Kasih telah memberikan testimoni anda !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function practice()
    {
        $years = Practice::select(DB::raw('LEFT(`created_at`, 4) AS year'))
                            ->distinct()
                            ->get();
                            
        $practices = Practice::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.practice.index', compact('practices', 'years'));
    }

}
