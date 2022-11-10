<?php

namespace App\Http\Controllers\Lead;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadNewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.news-category.index', compact('categories'));
    }

    public function create()
    {
        return view('lead.news-category.add');
    }

    public function store(Request $request)
    {
        NewsCategory::create($request->all());

        $notification = array(
            'message' => 'Kategori berita berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('lead.news-category')->with($notification);
    }

    public function edit($id)
    {
        $category = NewsCategory::findOrFail($id);
        return view('lead.news-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        NewsCategory::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Kategori berita berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('lead.news-category')->with($notification);
    }

    public function destroy($id){
        NewsCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Kategori berita berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
