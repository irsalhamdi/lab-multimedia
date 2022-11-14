<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class AdminResearchController extends Controller
{
    public function index()
    {
        $researchs = Research::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.research.index', compact('researchs'));
    }

    public function show($id)
    {
        $research = Research::findOrFail($id);
        return view('admin.research.detail', compact('research'));
    }

    public function acc(Request $request ,$id)
    {   
        Research::findOrFail($id)->update([
            'status' => 1,
            'information' => $request->information
        ]);

        $notification = [
            'message' => 'Penelitian berhasil dikonfirmasi !',
            'alert-type' => 'info',
        ];
        return redirect()->route('admin.research')->with($notification);
    }
}
