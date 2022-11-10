<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        return view('auth.register', compact('contact', 'regency', 'district', 'village'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'nim' => ['min:10'],
            'phone' => ['min:10'],
            'address' => ['min:5'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'email.unique' => 'Email telah terdaftar',
            'nim.min' => 'NIM harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'address.min' => 'Alamat harus minimal 5 karakter',
        ]);

        $data = User::where('nim', $request->nim)->first();

        if(!$data){

            $notification = array(
                'message' => 'Data anda tidak ditemukan, silahkan hubungi administrator !',
                'alert-type' => 'error',
            );

            return redirect()->route('register')->with($notification);
        }else{
            $id = $data->id;
            User::findOrFail($id)->update([
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
    
            return redirect()->route('login')->with($notification);
        }
    }
}
