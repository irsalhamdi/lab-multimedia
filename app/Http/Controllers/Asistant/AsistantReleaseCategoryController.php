<?php

namespace App\Http\Controllers\Asistant;

use Illuminate\Http\Request;
use App\Models\ReleaseCategory;
use App\Http\Controllers\Controller;

class AsistantReleaseCategoryController extends Controller
{
    public function index()
    {
        $categories = ReleaseCategory::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('asistant.release-category.index', compact('categories'));
    }

    public function create()
    {
        return view('asistant.release-category.add');
    }

    public function store(Request $request)
    {
        ReleaseCategory::create($request->all());

        $notification = array(
            'message' => 'Kategori rilis berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.release-category')->with($notification);
    }

    public function edit($id)
    {
        $category = ReleaseCategory::findOrFail($id);
        return view('asistant.release-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        ReleaseCategory::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Kategori rilis berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('asistant.release-category')->with($notification);
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
