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
            'teacher' => 'min:5',
            'lesson' => 'min:5',
        ], [
            'teacher.min' => 'Deskripsi minimal 5 karakter',
            'lesson.min' => 'Mata Kuliah minimal 5 karakter',
        ]);

        Schedule::create([
            'hour' => $request->hour,
            'endhour' => $request->endhour,
            'tanggal' => date('Y-m-d',strtotime($request->hour)),
            'teacher' => $request->teacher,
            'lesson' => $request->lesson,
            ]);

        $notification = array(
            'message' => 'Jadwal berhasil ditambahkan !',
            'alert-type' => 'success',
        );
    
        return redirect()->route('admin.schedules')->with($notification);
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher' => '|min:5',
            'lesson' => '|min:5',
        ], [
            'teacher.min' => 'Deskripsi minimal 5 karakter',
            'lesson.min' => 'Mata Kuliah minimal 5 karakter',
        ]);

        $schedule = Schedule::findOrFail($id);


        Schedule::findOrFail($schedule->id)->update([
            'hour' => $request->hour,
            'endhour' => $request->endhour,
            'tanggal' => date('Y-m-d',strtotime($request->hour)),
            'teacher' => $request->teacher,
            'lesson' => $request->lesson,
        ]);

            $notification = array(
                'message' => 'Jadwal berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('admin.schedules')->with($notification);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete(); 

        $notification = array(
            'message' => 'Jadwal berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }
}
