<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ToolExport;
use App\Models\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('name', 'ASC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        return view('admin.tools.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'quantity' => 'required|min:1',
            'image' => 'required|mimes:png,jpg,jpeg'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.min' => 'Jumlah minimal 1 karakter',
            'image.required' => 'Gambar wajib diisi',
            'image.mimes' => 'Tipe file harus png,jpg atau jpeg',
        ]);

        $file = $request->file('image');
        $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('upload/tools'),$fileName);
        $url = 'upload/tools/' . $fileName;

        Tool::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'image' => $url,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Peralatan berhasil ditambahkan !',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.tools')->with($notification);
    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5',
            'quantity' => 'required|min:1',
            'image' => 'mimes:png,jpg,jpeg'
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.min' => 'Jumlah minimal 1 karakter',
            'image.mimes' => 'Tipe file harus png,jpg atau jpeg',
        ]);

        $tool = Tool::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($tool->image))) {
                @unlink($tool->image);
            }

            $file = $request->file('image');
            $fileName = $tool->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/tools'),$fileName);
            $url = 'upload/tools/' . $fileName;

            Tool::find($tool->id)->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'image' => $url,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Peralatan berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.tools')->with($notification);
        }

        Tool::find($tool->id)->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Peralatan berhasil diupdate !',
            'alert-type' => 'info',
        ];

        return redirect()->route('admin.tools')->with($notification);
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);

        if (file_exists(public_path($tool->image))) {
            @unlink($tool->image);
        }

        $tool->delete(); 

        $notification = array(
            'message' => 'Peralatan berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export()
    {   
        return $this->excel->download(new ToolExport, 'peralatan.xlsx');
    }
}
