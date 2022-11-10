<?php

namespace App\Http\Controllers\Asistant;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistantProfileController extends Controller
{
    public function vission()
    {
        $profile = Profile::find(1);
        return view('asistant.profile-lab.vission', compact('profile'));
    }
    
    
    public function vissionUpdate(Request $request)
    {
        $request->validate([
            'vission' => ['required', 'min:20'],
        ], [
            'vission.required' => 'Visi wajid diisi',
            'visson.min' => 'Visi harus minimal 20 karakter',
        ]);
        
        Profile::findOrFail(1)->update($request->all());
        
        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'info',
        );
        
        return redirect()->back()->with($notification);
    }
    
    public function mission()
    {
        $profile = Profile::find(1);
        return view('asistant.profile-lab.mission', compact('profile'));
    }

    
    public function missionUpdate(Request $request)
    {
        $request->validate([
            'mission' => ['required', 'min:20'],
        ], [
            'mission.required' => 'Misi wajid diisi',
            'mission.min' => 'Misi harus minimal 20 karakter',
        ]);
        
        Profile::findOrFail(1)->update($request->all());
        
        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'info',
        );
        
        return redirect()->back()->with($notification);
    }
    
    public function goal()
    {
        $profile = Profile::find(1);
        return view('asistant.profile-lab.goal', compact('profile'));
    }
    
    public function goalUpdate(Request $request)
    {
        $request->validate([
            'goal' => ['required', 'min:20'],
        ], [
            'goal.required' => 'Tujuan wajid diisi',
            'goal.min' => 'Tujuan harus minimal 20 karakter',
        ]);

        Profile::findOrFail(1)->update($request->all());
        
        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
