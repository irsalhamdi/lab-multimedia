<?php

namespace App\Http\Controllers\Dosen;

use App\Exports\ParticipantCommunityDedicationsExport;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CommunityDedication;
use App\Http\Controllers\Controller;
use App\Mail\CommunityDedicationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CommunityDedicationGuide;
use App\Models\ParticipantCommunityDedication;
use Maatwebsite\Excel\Excel;
use PhpParser\Node\Stmt\Do_;

class CommunityDedicationController extends Controller
{
    public function index()
    {
        $dedications = CommunityDedication::where('dosen_id', Auth::guard('dosen')->user()->id)->filter(request(['search']))->paginate(3)->withQueryString();
        return view('dosen.community-dedication.index', compact('dedications'));
    }

    public function create()
    {
        return view('dosen.community-dedication.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skema' => ['required', 'min:5'],
            'name' => ['required', 'min:5'],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
            'description' => ['required', 'min:10'],
            'participants' => ['required', 'min:1'],
            'place' => ['required', 'min:5'],
            'date' => ['required'],
        ], [
            'skema.required' => 'Skema wajib diisi',
            'skema.min' => 'Skema minimal 5 karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 5 karakter',
            'image.required' => 'Gambar wajib diisi',
            'image.mimes' => 'tipe file harus jpg, jpeg, atau png',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'participants.required' => 'Jumlah anggota wajib diisi',
            'participants.min' => 'Jumlah anggota minimal 1 karakter',
            'place.required' => 'Tempat wajib diisi',
            'place.min' => 'Tempat minimal 5 karakter',
            'date.required' => 'Waktu wajib diisi',
        ]);

        if($request->file('image')){

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/dedication/'),$fileName);
            $url = 'upload/dedication/' . $fileName;

            CommunityDedication::create([
                'dosen_id' => Auth::guard('dosen')->user()->id,
                'skema' => $request->skema,
                'name' => $request->name,
                'image' => $url,
                'participants' => $request->participants,
                'place' => $request->place,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Pengabdian berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('dosen.community.dedication')->with($notification);
        }

    }

    public function edit($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        return view('dosen.community-dedication.edit', compact('dedication'));
    }

    public function show($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        return view('dosen.community-dedication.detail', compact('dedication'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skema' => ['required', 'min:5'],
            'name' => ['required', 'min:5'],
            'image' => ['mimes:jpg,jpeg,png'],
            'description' => ['required', 'min:10'],
            'participants' => ['required', 'min:1'],
            'place' => ['required', 'min:5'],
            'date' => ['required'],
        ], [
            'skema.required' => 'Skema wajib diisi',
            'skema.min' => 'Skema minimal 5 karakter',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 5 karakter',
            'image.mimes' => 'tipe file harus jpg, jpeg, atau png',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'participants.required' => 'Jumlah anggota wajib diisi',
            'participants.min' => 'Jumlah anggota minimal 1 karakter',
            'place.required' => 'Tempat wajib diisi',
            'place.min' => 'Tempat minimal 5 karakter',
            'date.required' => 'Waktu wajib diisi',
        ]);

        $dedication = CommunityDedication::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($dedication->image))) {
                @unlink($dedication->image);
            }

            $file = $request->file('image');
            $fileName = $dedication->id .date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/dedication/'),$fileName);
            $url = 'upload/dedication/' . $fileName;

            CommunityDedication::findOrFail($dedication->id)->update([
                'skema' => $request->skema,
                'name' => $request->name,
                'image' => $url,
                'participants' => $request->participants,
                'place' => $request->place,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Pengabdian berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('dosen.community.dedication')->with($notification);
        }else{

            CommunityDedication::findOrFail($dedication->id)->update([
                'skema' => $request->skema,
                'name' => $request->name,
                'participants' => $request->participants,
                'place' => $request->place,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Pengabdian berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('dosen.community.dedication')->with($notification);
        }
    }

    public function destroy($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        @unlink($dedication->image);
        $dedication->delete(); 

        $notification = array(
            'message' => 'Pengabdian berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

    public function participants($id)
    {
        $participants = ParticipantCommunityDedication::with('user', 'dosen')->where('dedication_id', $id)->get();
        $dedication = CommunityDedication::findOrFail($id);
        $quota = ParticipantCommunityDedication::where('dedication_id', $id)->count();
        return view('dosen.community-dedication.participant', compact('participants', 'dedication', 'quota'));
    }

    public function participantsAdd($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        $users = User::latest()->get();
        $dosens = Dosen::latest()->get();
        
        return view('dosen.community-dedication.participat-add', compact('dedication', 'users', 'dosens'));
    }

    public function participantsStore(Request $request, $id)
    {   
        $dedication = CommunityDedication::findOrFail($id);
        $available = ParticipantCommunityDedication::where('dedication_id', $dedication->id)->count();

        if($available == $dedication->participants){
            $notification = array(
                'message' => 'Kuota pengabdian telah penuh !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        if($dedication->dosen_id == $request->dosen_id){
            $notification = array(
                'message' => 'Anda Pemilik pengabdian !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        };

        if($request->user_id)
        {
            $user = ParticipantCommunityDedication::where(['user_id' => $request->user_id, 'dedication_id' => $id])->first();
            if($user){
                $notification = array(
                    'message' => 'Mahasiwa telah terdaftar !',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }

            ParticipantCommunityDedication::create([
                'user_id' => $request->user_id,
                'dedication_id' => $id
            ]);

            $user = User::where('id', $request->user_id)->first();

            $data = [
                'dosen' => Auth::guard('dosen')->user()->name,
                'name' => $dedication->name,
                'place' => $dedication->place,
                'date' => $dedication->date,
                'link' => 'http://127.0.0.1:8000/mahasiswa/pengabdian-masyarakat/lain/'.$dedication->id,
                'email' => $user->name,
            ];
    
            Mail::to($user->email)->send(new CommunityDedicationMail($data));
    
            return redirect()->route('dosen.community.dedication.participants', $id)->with('complete', 'Mahasiswa berhasil ditambahkan, kami telah mengirimkan email kepada mahasiswa tersebut yang berisi info pengabdian anda !');

        }

        $dosen = ParticipantCommunityDedication::where(['dosen_id' => $request->dosen_id, 'dedication_id' => $id])->first();
        
        if($dosen){
            $notification = array(
                'message' => 'Dosen telah terdaftar !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        ParticipantCommunityDedication::create([
            'dosen_id' => $request->dosen_id,
            'dedication_id' => $id
        ]);
        
        $dosen = Dosen::where('id', $request->dosen_id)->first();

        $data = [
            'dosen' => Auth::guard('dosen')->user()->name,
            'name' => $dedication->name,
            'place' => $dedication->place,
            'date' => $dedication->date,
            'link' => 'http://127.0.0.1:8000/dosen/pengabdian-masyarakat/lain/'.$dedication->id,
            'email' => $dosen->name,
        ];

        Mail::to($dosen->email)->send(new CommunityDedicationMail($data));

        $notification = array(
            'message' => 'Dosen Berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('dosen.community.dedication.participants', $id)->with('complete', 'Dosen berhasil ditambahkan, kami telah mengirimkan email kepada dosen tersebut yang berisi info pengabdian anda !');
    }

    public function participantsDestroy($id)
    {
        ParticipantCommunityDedication::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Peserta berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

    public function participantsDetailUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('dosen.community-dedication.participant-user', compact('user'));
    }

    public function participantsDetailDosen($id)
    {
        $dosen = Dosen::where('id', $id)->first();
        return view('dosen.community-dedication.participant-dosen', compact('dosen'));
    }
    
    public function joins()
    {
        $participants = ParticipantCommunityDedication::with('dedication', 'dosen')->where('dosen_id', Auth::guard('dosen')->user()->id)->get();
        return view('dosen.community-dedication.joins', compact('participants'));
    }

    public function join($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        $guide = CommunityDedicationGuide::where('community_dedication_id', $dedication->id)->first();
        return view('dosen.community-dedication.join', compact('dedication', 'guide'));
    }

    public function guide($id)
    {
        $dedication = CommunityDedication::findOrFail($id);
        $guide = CommunityDedicationGuide::where('community_dedication_id', $dedication->id)->first();
        return view('dosen.community-dedication.guide', compact('dedication', 'guide'));
    }

    public function uploadGuide(Request $request, $id)
    {
            $request->validate([
                'file' => 'mimes:pdf|max:2048',
            ],[
                'file.mimes' => 'tipe file harus pdf',
                'file.max' => 'file max 2048 MB',
            ]);
    
            $dedication = CommunityDedication::findOrFail($id);
            $guide = CommunityDedicationGuide::where('community_dedication_id', $dedication->id)->first();
    
            if($guide){
    
                if(file_exists(public_path('upload/dedication/guide/'.$guide->file))) {
                    @unlink('upload/dedication/guide/'.$guide->file);
                }            
    
                $file = $request->file('file');
                $destinationPath = 'upload/dedication/guide';
                $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath,$name);
    
                CommunityDedicationGuide::findOrFail($guide->id)->update([
                    'file' => $name,
                ]);
    
                $notification = array(
                    'message' => 'Panduan pengabdian berhasil diupdate !',
                    'alert-type' => 'info',
                );
        
                return redirect()->back()->with($notification);
            }
    
            $file = $request->file('file');
            $destinationPath = 'upload/dedication/guide';
            $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$name);
    
            CommunityDedicationGuide::create([
                'community_dedication_id' => $dedication->id,
                'name' => $dedication->name,
                'file' => $name,
            ]);
    
            $notification = array(
                'message' => 'Panduan pengabdian berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->back()->with($notification);
    }

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export($id)
    {
        $participant = CommunityDedication::findOrFail($id);

        $name = $participant->name.'xlsx';
        
        return $this->excel->download(new ParticipantCommunityDedicationsExport($id), $name);
    }
}
