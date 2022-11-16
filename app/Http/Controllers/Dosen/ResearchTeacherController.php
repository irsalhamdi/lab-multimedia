<?php

namespace App\Http\Controllers\Dosen;

use App\Exports\ParticpantResearchTeacherExport;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Models\ResearchTeacher;
use App\Mail\ResearchTeacherMail;
use App\Models\ResearchParticipant;
use App\Http\Controllers\Controller;
use App\Models\ResearchResultTeacher;
use App\Models\ResearchTeacherGuide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ResearchTeacherController extends Controller
{
    public function index()
    {
        $researchs = ResearchTeacher::where('dosen_id', Auth::guard('dosen')->user()->id)->filter(request(['search']))->paginate(3)->withQueryString();
        return view('dosen.research.index', compact('researchs'));
    }

    public function create()
    {
        return view('dosen.research.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5'],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
            'description' => ['required', 'min:10'],
            'participants' => ['required', 'min:1'],
            'date' => ['required'],
        ], [
            'title.required' => 'Judul Penelitian wajib diisi',
            'title.min' => 'Judul Penelitian minimal 5 karakter',
            'image.required' => 'Gambar wajib diisi',
            'image.mimes' => 'tipe file harus jpg, jpeg, atau png',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'participants.required' => 'Jumlah anggota wajib diisi',
            'participants.min' => 'Jumlah anggota minimal 1 karakter',
            'date.required' => 'Waktu wajib diisi',
        ]);

        if($request->file('image')){

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/research-teacher/'),$fileName);
            $url = 'upload/research-teacher/' . $fileName;

            ResearchTeacher::create([
                'dosen_id' => Auth::guard('dosen')->user()->id,
                'title' => $request->title,
                'image' => $url,
                'participants' => $request->participants,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Penelitian berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->route('dosen.penelitian')->with($notification);
        }

    }

    public function edit($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        return view('dosen.research.edit', compact('research'));
    }

    public function show($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        return view('dosen.research.detail', compact('research'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:5'],
            'image' => ['mimes:jpg,jpeg,png'],
            'description' => ['required', 'min:10'],
            'participants' => ['required', 'min:1'],
            'date' => ['required'],
        ], [
            'title.required' => 'Nama wajib diisi',
            'title.min' => 'Nama minimal 5 karakter',
            'image.mimes' => 'tipe file harus jpg, jpeg, atau png',
            'description.required' => 'Deskripsi wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'participants.required' => 'Jumlah anggota wajib diisi',
            'participants.min' => 'Jumlah anggota minimal 1 karakter',
            'date.required' => 'Waktu wajib diisi',
        ]);

        $research = ResearchTeacher::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($research->image))) {
                @unlink($research->image);
            }

            $file = $request->file('image');
            $fileName = $research->id .date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/research-teacher/'),$fileName);
            $url = 'upload/research-teacher/' . $fileName;

            ResearchTeacher::findOrFail($research->id)->update([
                'title' => $request->title,
                'image' => $url,
                'participants' => $request->participants,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Penelitian berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('dosen.penelitian')->with($notification);
        }else{

            ResearchTeacher::findOrFail($research->id)->update([
                'title' => $request->title,
                'participants' => $request->participants,
                'date' => $request->date,
                'description' => $request->description,
                'excerpt' => Str::limit(strip_tags($request->description), 200)
            ]);

            $notification = array(
                'message' => 'Penelitian berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->route('dosen.penelitian')->with($notification);
        }
    }

    public function destroy($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        @unlink($research->image);
        $research->delete(); 

        $notification = array(
            'message' => 'Penelitian berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

    public function participants($id)
    {
        $participants = ResearchParticipant::with('user', 'dosen')->where('research_id', $id)->get();
        $research = ResearchTeacher::findOrFail($id);
        $quota = ResearchParticipant::where('research_id', $id)->count();
        return view('dosen.research.participant', compact('participants', 'research', 'quota'));
    }

    public function participantsAdd($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        $users = User::latest()->get();
        $dosens = Dosen::latest()->get();
        
        return view('dosen.research.participat-add', compact('research', 'users', 'dosens'));
    }

    public function participantsStore(Request $request, $id)
    {   
        $research = ResearchTeacher::findOrFail($id);
        $available = ResearchParticipant::where('research_id', $research->id)->count();

        if($available == $research->participants){
            $notification = array(
                'message' => 'Kuota penelitian telah penuh !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        if($research->dosen_id == $request->dosen_id){
            $notification = array(
                'message' => 'Anda Pemilik penelitian !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        };

        if($request->user_id)
        {
            $user = ResearchParticipant::where(['user_id' => $request->user_id, 'research_id' => $id])->first();
            if($user){
                $notification = array(
                    'message' => 'Mahasiwa telah terdaftar !',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }

            ResearchParticipant::create([
                'user_id' => $request->user_id,
                'research_id' => $id
            ]);

            $user = User::where('id', $request->user_id)->first();

            $data = [
                'dosen' => Auth::guard('dosen')->user()->name,
                'title' => $research->title,
                'date' => $research->date,
                'link' => 'http://127.0.0.1:8000/penelitian/lain/'.$research->id,
                'email' => $user->name,
            ];
    
            Mail::to($user->email)->send(new ResearchTeacherMail($data));
    
            return redirect()->route('dosen.penelitian.participants', $id)->with('complete', 'Mahasiswa berhasil ditambahkan, kami telah mengirimkan email kepada mahasiswa tersebut yang berisi info penelitian anda !');

        }

        $dosen = ResearchParticipant::where(['dosen_id' => $request->dosen_id, 'research_id' => $id])->first();
        
        if($dosen){
            $notification = array(
                'message' => 'Dosen telah terdaftar !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }

        ResearchParticipant::create([
            'dosen_id' => $request->dosen_id,
            'research_id' => $id
        ]);
        
        $dosen = Dosen::where('id', $request->dosen_id)->first();

        $data = [
            'dosen' => Auth::guard('dosen')->user()->name,
            'title' => $research->title,
            'date' => $research->date,
            'link' => 'http://127.0.0.1:8000/dosen/penelitian/lain/'.$research->id,
            'email' => $dosen->name,
        ];

        Mail::to($dosen->email)->send(new ResearchTeacherMail($data));

        $notification = array(
            'message' => 'Dosen Berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->route('dosen.penelitian.participants', $id)->with('complete', 'Dosen berhasil ditambahkan, kami telah mengirimkan email kepada dosen tersebut yang berisi info penelitian anda !');
    }

    public function participantsDestroy($id)
    {
        ResearchParticipant::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Peserta berhasil dihapus !',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

    public function participantsDetailUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('dosen.research.participant-user', compact('user'));
    }

    public function participantsDetailDosen($id)
    {
        $dosen = Dosen::where('id', $id)->first();
        return view('dosen.research.participant-dosen', compact('dosen'));
    }
    
    public function joins()
    {
        $participants = ResearchParticipant::with('research', 'dosen')->where('dosen_id', Auth::guard('dosen')->user()->id)->get();
        return view('dosen.research.joins', compact('participants'));
    }

    public function join($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        $guide = ResearchTeacherGuide::where('research_id', $research->id)->first();
        return view('dosen.research.join', compact('research', 'guide'));
    }

    public function guide($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        $guide = ResearchTeacherGuide::where('research_id', $research->id)->first();
        return view('dosen.research.guide', compact('research', 'guide'));
    }

    public function uploadGuide(Request $request, $id)
    {
            $request->validate([
                'file' => 'mimes:pdf|max:2048',
            ],[
                'file.mimes' => 'tipe file harus pdf',
                'file.max' => 'file max 2048 MB',
            ]);
    
            $research = ResearchTeacher::findOrFail($id);
            $guide = ResearchTeacherGuide::where('research_id', $research->id)->first();
    
            if($guide){
    
                if(file_exists(public_path('upload/research-teacher/guide/'.$guide->file))) {
                    @unlink('upload/research-teacher/guide/'.$guide->file);
                }            
    
                $file = $request->file('file');
                $destinationPath = 'upload/research-teacher/guide';
                $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath,$name);
    
                ResearchTeacherGuide::findOrFail($guide->id)->update([
                    'file' => $name,
                ]);
    
                $notification = array(
                    'message' => 'Panduan penelitian berhasil diupdate !',
                    'alert-type' => 'info',
                );
        
                return redirect()->back()->with($notification);
            }
    
            $file = $request->file('file');
            $destinationPath = 'upload/research-teacher/guide';
            $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$name);
    
            ResearchTeacherGuide::create([
                'research_id' => $research->id,
                'name' => $research->title,
                'file' => $name,
            ]);
    
            $notification = array(
                'message' => 'Panduan penelitian berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->back()->with($notification);
    }

    public function result($id)
    {
        $research = ResearchTeacher::findOrFail($id);
        $result = ResearchResultTeacher::where('research_teacher_id', $research->id)->first();

        return view('dosen.research.result', compact('research', 'result'));
    }

    public function resultSubmit(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:pdf'
        ], [
            'file.mimes' => 'tipe file pdf',
        ]);

        $research = ResearchTeacher::findOrFail($id);
        $result = ResearchResultTeacher::where('research_teacher_id', $research->id)->first();
        if($result){

            if(file_exists(public_path('upload/research-teacher/result/'.$result->file))) {
                @unlink('upload/research-teacher/result/'.$result->file);
            }            

            $file = $request->file('file');
            $destinationPath = 'upload/research-teacher/result';
            $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$name);

            ResearchResultTeacher::findOrFail($result->id)->update([
                'file' => $name,
            ]);
    
            $notification = array(
                'message' => 'Hasil penelitian berhasil diupdate !',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }

        $file = $request->file('file');
        $destinationPath = 'upload/research-teacher/result';
        $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath,$name);

        ResearchResultTeacher::create([
            'research_teacher_id' => $research->id,
            'file' => $name,
        ]);
        
        $notification = array(
            'message' => 'Hasil penelitian berhasil ditambahkan !',
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
        $participant = ResearchTeacher::findOrFail($id);

        $name = $participant->title.'.xlsx';
        
        return $this->excel->download(new ParticpantResearchTeacherExport($id), $name,Excel::XLSX);
    }
}
