<?php

namespace App\Http\Controllers\Lead;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GalleryActivity;
use App\Http\Controllers\Controller;

class LeadGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('lead.gallery.add');
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

            $id = Gallery::insertGetId([
                'title' => $request->title,
                'image' => $url,
            ]);

            $images = $request->file('gambar');

            foreach($images  as $image){
    
                $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/gallery/activity'), $name);
                $urlActivity = 'upload/gallery/activity/' . $name;
    
                GalleryActivity::insert([
                    'gallery_id' => $id,
                    'gambar' => $urlActivity,
                ]);
            }

            $notification = array(
                'message' => 'Galeri berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('lead.galleries')->with($notification);
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('lead.gallery.edit', compact('gallery'));
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
    
            return redirect()->route('lead.galleries')->with($notification);
        }else{

            Gallery::findOrFail($gallery->id)->update([
                'title' => $request->title,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('lead.galleries')->with($notification);
        }

    }

    public function editImage($id)
    {
        $gallery = Gallery::findOrFail($id);
        $galleries = GalleryActivity::where('gallery_id', $gallery->id)->get();
        
        return view('lead.gallery.edit-image', compact('gallery', 'galleries'));
    }

    public function updateImage(Request $request )
    {   
        $images = $request->gambar;
        
		foreach ($images as $id => $img) {

            $name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('upload/gallery/activity/'),$name);
            $url = 'upload/gallery/activity/' . $name;

            GalleryActivity::where('id',$id)->update([
                'gambar' => $url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function deleteImage($id)
    {
        GalleryActivity::findOrFail($id)->delete();

        $notification = array(
           'message' => 'Gallery berhasil dihapus !',
           'alert-type' => 'warning'
       );

       return redirect()->back()->with($notification);
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
