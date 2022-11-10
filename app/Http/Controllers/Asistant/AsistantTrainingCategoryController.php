<?php

namespace App\Http\Controllers\Asistant;

use Illuminate\Http\Request;
use App\Models\TrainingCategory;
use App\Http\Controllers\Controller;

class AsistantTrainingCategoryController extends Controller
{
    public function index()
    {
        $trainings = TrainingCategory::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('asistant.training-category.index', compact('trainings'));
    }

    public function create()
    {
        return view('asistant.training-category.add');
    }

    public function store(Request $request)
    {
        TrainingCategory::create($request->all());

        $notification = array(
            'message' => 'Kategori pelatihan berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('asistant.training-category')->with($notification);
    }

    public function edit($id)
    {
        $training = TrainingCategory::findOrFail($id);
        return view('asistant.training-category.edit', compact('training'));
    }

    public function update(Request $request, $id)
    {
        TrainingCategory::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Kategori pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->route('asistant.training-category')->with($notification);
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
