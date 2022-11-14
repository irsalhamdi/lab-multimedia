<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
        ], [
            'title.required' => 'Judul wajib diisi',
            'title.min' => 'Judul minimal 5 karakter',
        ]);

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/gallery'),$fileName);
            $url = 'upload/gallery/' . $fileName;

            Gallery::create([
                'title' => $request->title,
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('admin.galleries')->with($notification);
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:5',
        ], [
            'title.required' => 'Judul wajib diisi',
        ]);

        $gallery = Gallery::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($gallery->image))) {
                @unlink($gallery->image);
            }

            $file = $request->file('image');
            $fileName = $gallery->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/gallery/'),$fileName);
            $url = 'upload/gallery/' . $fileName;

            Gallery::findOrFail($gallery->id)->update([
                'title' => $request->title,
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.galleries')->with($notification);
        }else{

            Gallery::findOrFail($gallery->id)->update([
                'title' => $request->title,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.galleries')->with($notification);
        }

    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        @unlink($gallery->image);
        $gallery->delete(); 

        $notification = array(
            'message' => 'Galeri berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
