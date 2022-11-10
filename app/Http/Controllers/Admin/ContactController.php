<?php

namespace App\Http\Controllers\Admin;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Province;

class ContactController extends Controller
{   
    public function index()
    {   
        $contact = Contact::with(['province', 'regency', 'district', 'village'])->find(1);
        $provinces = Province::orderBy('name', 'ASC')->get();
        return view('admin.contact.index', compact('contact', 'provinces'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'zip_code' => ['min:5'],
            'address' => ['min:5'],
            'phone' => ['min:10'],
        ], [
            'zip_code.min' => 'Kode pos harus minimal 5 karakter',
            'address.min' => 'Alamat harus minimal 5 karakter',
            'phone.min' => 'No handphone harus minimal 10 karakter',
        ]);

        Contact::findOrFail(1)->update($request->all());
        
        $notification = array(
            'message' => 'Kontak berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    public function GetRegency($province_id){
        
        $regency = Regency::where('province_id', $province_id)->orderBy('name', 'ASC')->get();
        return json_encode($regency);
    }

    public function GetDisctrict($regency_id){

        $district = District::where('regency_id', $regency_id)->orderBy('name', 'ASC')->get();
        return json_encode($district);
    }

    public function GetVillage($district_id){

        $village = Village::where('district_id', $district_id)->orderBy('name', 'ASC')->get();
        return json_encode($village);
    }
}
