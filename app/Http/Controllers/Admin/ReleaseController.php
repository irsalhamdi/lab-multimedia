<?php

namespace App\Http\Controllers\Admin;

use App\Models\Release;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReleaseCategory;
use App\Http\Controllers\Controller;

class ReleaseController extends Controller
{
    public function index()
    {   
        $releases = Release::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.release.index', compact('releases'));
    }

    public function create()
    {
        $categories = ReleaseCategory::orderBy('name', 'ASC')->get();
        return view('admin.release.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'release_categories_id' => 'required',
            'name' => ['required', 'min:8', 'unique:trainings,name'],
            'file' => ['mimes:pdf,png,jpg,jpeg|max:2048'],
        ], [
            'release_categories_id.required' => 'Kategori rilis wajib diisi',
            'name.required' => 'Nama rilis wajib diisi',
            'name.min' => 'Nama rilis minimal 8 karakter',
            'name.unique' => 'Nama rilis telah terdaftar di database',
            'file.mimes' => 'tipe file harus pdf, png, jpg, atau jpeg',
            'file.max' => 'file max 2048 MB',
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/release'),$fileName);
            $url = 'upload/release/' . $fileName;

            Release::create([
                'release_categories_id' => $request->release_categories_id,
                'name' => $request->name,
                'description' => $request->description,
                'file' => $url,
            ]);

            $notification = array(
                'message' => 'Rilis berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('admin.release')->with($notification);

        }

        Release::create([
            'release_categories_id' => $request->release_categories_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $notification = array(
            'message' => 'Rilis berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.release')->with($notification);
    }

    public function edit($id)
    {
        $release = Release::findOrFail($id);
        $categories = ReleaseCategory::orderBy('name', 'ASC')->get();
        return view('admin.release.edit', compact('release', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $release = Release::findOrFail($id);
        $request->validate([
            'release_categories_id' => 'required',
            'name' => ['required', 'min:8', 'unique:trainings,name'],
            'file' => ['mimes:pdf,png,jpg,jpeg|max:2048'],
        ], [
            'release_categories_id.required' => 'Kategori rilis wajib diisi',
            'name.required' => 'Nama rilis wajib diisi',
            'name.min' => 'Nama rilis minimal 8 karakter',
            'name.unique' => 'Nama rilis telah terdaftar di database',
            'file.mimes' => 'Tipe file harus pdf, png, jpg, atau jpeg',
            'file.max' => 'file max 2048 MB',
        ]);

        if($request->file('file')){

            if (file_exists(public_path($release->file))) {
                @unlink($release->file);
            }

            $file = $request->file('file');
            $fileName = $release->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/release'),$fileName);
            $url = 'upload/release/' . $fileName;

            Release::findOrFail($release->id)->update([
                'release_categories_id' => $request->release_categories_id,
                'name' => $request->name,
                'file' => $url,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Rilis berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.release')->with($notification);
        }else{

            Release::findOrFail($release->id)->update([
                'release_categories_id' => $request->release_categories_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Rilis berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.release')->with($notification);
        }

    }

    public function show($id)
    {
        $release = Release::findOrFail($id);
        $name = Str::substr($release->file, -3);
        
        return view('admin.release.detail', compact('release', 'name'));
    }

    public function destroy($id)
    {
        $release = Release::findOrFail($id);
        
        if(file_exists(public_path($release->file))) {
            @unlink($release->file);
        }
        Release::findOrFail($release->id)->delete();

        $notification = array(
            'message' => 'Rilis berhasil dihapus !',
            'alert-type' => 'warning',
        );
    
        return redirect()->back()->with($notification);
    }
}
