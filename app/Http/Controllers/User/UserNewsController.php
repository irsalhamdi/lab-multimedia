<?php

namespace App\Http\Controllers\User;

use App\Models\News;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserNewsController extends Controller
{
    public function index()
    {
        $news = News::where('user_id', Auth::user()->id)->latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('user.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('name', 'ASC')->get();
        return view('user.news.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'news_categories_id' => 'required',
            'description' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'Judul wajib diisi',
            'news_categories_id.required' => 'Kategori wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'image.mimes' => 'Image wajib diisi',
        ]);

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/news'),$fileName);
            $url = 'upload/news/' . $fileName;

            News::create([
                'user_id' => Auth::user()->id,
                'news_categories_id' => $request->news_categories_id,
                'title' => $request->title,
                'image' => $url,
                'video' => $request->video,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200),
                'status' => 0
            ]);

            $notification = array(
                'message' => 'Berita berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('mahasiswa.berita')->with($notification);

        }else{

            $notification = array(
                'message' => 'Image wajib diisi !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = NewsCategory::orderBy('name', 'ASC')->get();
        return view('user.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'news_categories_id' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Judul wajib diisi',
            'news_categories_id.required' => 'Kategori wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'image.mimes' => 'Image wajib diisi',
        ]);

        $news = News::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($news->image))) {
                @unlink($news->image);
            }

            $file = $request->file('image');
            $fileName = $news->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/news/'),$fileName);
            $url = 'upload/news/' . $fileName;

            News::findOrFail($news->id)->update([
                'news_categories_id' => $request->news_categories_id,
                'title' => $request->title,
                'image' => $url,
                'video' => $request->video,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Berita berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('mahasiswa.berita')->with($notification);
        }else{

            News::findOrFail($news->id)->update([
                'news_categories_id' => $request->news_categories_id,
                'title' => $request->title,
                'video' => $request->video,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Berita berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('mahasiswa.berita')->with($notification);
        }

    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('user.news.detail', compact('news'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        @unlink($news->image);
        $news->delete(); 

        $notification = array(
            'message' => 'Berita berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
