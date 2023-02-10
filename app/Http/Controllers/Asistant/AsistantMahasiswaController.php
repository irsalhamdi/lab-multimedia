<?php

namespace App\Http\Controllers\Asistant;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistantMahasiswaController extends Controller
{
    public function index()
    {
       $users =  User::orderBy('name', 'ASC')->filter(request(['search']))->paginate(10)->withQueryString();
       return view('asistant.mahasiswa.index', compact('users'));
    }

    public function create()
    {
        return view('asistant.mahasiswa.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => ['min:10', 'unique:users,nim'],
        ], [
            'nim.min' => 'NIM harus minimal 10 karakter',
            'nim.unique' => 'NIM telah terdaftar',
        ]);

        User::create($request->all());

        $notification = array(
            'message' => 'Mahasiswa berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.mahasiswa')->with($notification);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('asistant.mahasiswa.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
            'nim' => ['min:10'],
            'phone' => ['min:10'],
            'address' => ['min:5'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'nim.min' => 'NIM harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'address.min' => 'Alamat harus minimal 5 karakter',
        ]);

        User::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Profile Mahasiswa berhasil, diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('asistant.mahasiswa')->with($notification);
    }

    public function destroy($id){
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Mahasiswa berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
