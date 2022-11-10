<?php

namespace App\Http\Controllers\Asistant;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistantTeacherController extends Controller
{
    public function index()
    {
        $dosens =  Dosen::orderBy('name', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
       return view('asistant.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('asistant.dosen.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['min:10', 'unique:dosens,nip'],
        ], [
            'nip.min' => 'NIP harus minimal 10 karakter',
            'nip.unique' => 'NIP telah terdaftar',
        ]);

        Dosen::create($request->all());

        $notification = array(
            'message' => 'Dosen berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.dosen')->with($notification);
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('asistant.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
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

        Dosen::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile Dosen berhasil, diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('asistant.dosen')->with($notification);
    }

    public function destroy($id){
        Dosen::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Dosen berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
