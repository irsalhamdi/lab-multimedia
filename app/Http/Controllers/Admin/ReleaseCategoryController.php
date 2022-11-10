<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Release;
use App\Models\ReleaseCategory;
use Illuminate\Http\Request;

class ReleaseCategoryController extends Controller
{
    public function index()
    {
        $categories = ReleaseCategory::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.release-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.release-category.add');
    }

    public function store(Request $request)
    {
        ReleaseCategory::create($request->all());

        $notification = array(
            'message' => 'Kategori rilis berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.release-category')->with($notification);
    }

    public function edit($id)
    {
        $category = ReleaseCategory::findOrFail($id);
        return view('admin.release-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        ReleaseCategory::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Kategori rilis berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.release-category')->with($notification);
    }

    public function destroy($id){
        ReleaseCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Kategori rilis berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

}
