<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        $trainings = TrainingCategory::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.training-category.index', compact('trainings'));
    }

    public function create()
    {
        return view('admin.training-category.add');
    }

    public function store(Request $request)
    {
        TrainingCategory::create($request->all());

        $notification = array(
            'message' => 'Kategori pelatihan berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.training-category')->with($notification);
    }

    public function edit($id)
    {
        $training = TrainingCategory::findOrFail($id);
        return view('admin.training-category.edit', compact('training'));
    }

    public function update(Request $request, $id)
    {
        TrainingCategory::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Kategori pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.training-category')->with($notification);
    }

    public function destroy($id){
        TrainingCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Kategori pelatihan berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
