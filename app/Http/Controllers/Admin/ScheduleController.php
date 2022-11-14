<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedule.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:20',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 5 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 20 karakter',
        ]);

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/schedule'),$fileName);
            $url = 'upload/schedule/' . $fileName;

            Schedule::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('admin.schedules')->with($notification);
        }
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:20',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 5 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 20 karakter',
        ]);

        $schedule = Schedule::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($schedule->image))) {
                @unlink($schedule->image);
            }

            $file = $request->file('image');
            $fileName = $schedule->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/schedule/'),$fileName);
            $url = 'upload/schedule/' . $fileName;

            Schedule::findOrFail($schedule->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.schedules')->with($notification);
        }else{

            Schedule::findOrFail($schedule->id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Galeri berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.schedules')->with($notification);
        }

    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        @unlink($schedule->image);
        $schedule->delete(); 

        $notification = array(
            'message' => 'Galeri berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
