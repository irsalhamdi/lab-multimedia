<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SchedulePeriode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SchedulePeriodeController extends Controller
{
    public function index()
    {   
        $years = SchedulePeriode::select(DB::raw('LEFT(`created_at`, 4) AS year'))
                            ->distinct()
                            ->get();

        $schedules = SchedulePeriode::latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('admin.schedule-periode.index', compact('schedules', 'years'));
    }

    public function create()
    {
        return view('admin.schedule-periode.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'min:5',
            'file' => 'mimes:pdf,'
        ], [
            'name.min' => 'Jadwal minimal 5 karakter',
            'file.mimes' => 'Tipe File harus pdf',
        ]);

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/schedule'),$fileName);
            $url = 'upload/schedule/' . $fileName;

            SchedulePeriode::insert([
                'name' => $request->name,
                'file' => $url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Jadwal Semester berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('admin.schedule.period')->with($notification);
        }
    }

    public function edit($id)
    {
        $schedule = SchedulePeriode::findOrFail($id);
        return view('admin.schedule-periode.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'min:5',
            'file' => 'mimes:pdf,'
        ], [
            'name.min' => 'Jadwal minimal 5 karakter',
            'file.mimes' => 'Tipe File harus pdf',
        ]);

        $schedule = SchedulePeriode::findOrFail($id);

        if($request->file('file')){

            if (file_exists(public_path($schedule->file))) {
                @unlink($schedule->file);
            }

            $file = $request->file('file');
            $fileName = $schedule->id . date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/schedule/'),$fileName);
            $url = 'upload/schedule/' . $fileName;

            SchedulePeriode::findOrFail($schedule->id)->update([
                'name' => $request->name,
                'file' => $url,
            ]);

            $notification = array(
                'message' => 'Jadwal Semester berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.schedule.period')->with($notification);
        }else{

            SchedulePeriode::findOrFail($schedule->id)->update([
                'name' => $request->name,
            ]);

            $notification = array(
                'message' => 'Jadwal Semester berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.schedule.period')->with($notification);
        }

    }

    public function destroy($id)
    {
        $schedule = SchedulePeriode::findOrFail($id);
        @unlink($schedule->image);
        $schedule->delete(); 

        $notification = array(
            'message' => 'Jadwal Semester berhasil dihapus !',
            'alert-type' => 'warning',
        );
        
        return redirect()->back()->with($notification);
    }
}
