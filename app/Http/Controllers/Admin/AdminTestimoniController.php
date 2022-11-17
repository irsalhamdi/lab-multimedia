<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonie;
use Illuminate\Http\Request;

class AdminTestimoniController extends Controller
{
    public function index()
    {
        $testimonies = Testimonie::latest()->paginate(3);
        return view('admin.testimoni.index', compact('testimonies'));
    }

    public function acc(Request $request)
    {
        Testimonie::findOrFail($request->id)->update([
            'status' => 1
        ]);

        $notification = [
            'message' => 'Testimoni berhasil diupdate !',
            'alert-type' => 'info',
        ];

        return redirect()->back()->with($notification);
    }

    public function unacc(Request $request)
    {
        Testimonie::findOrFail($request->id)->update([
            'status' => 0
        ]);

        $notification = [
            'message' => 'Testimoni berhasil diupdate !',
            'alert-type' => 'info',
        ];

        return redirect()->back()->with($notification);
    }
}
