<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Certificate;
use App\Models\News;
use App\Models\User;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Regency;
use App\Models\Release;
use App\Models\Trainer;
use App\Models\Village;
use App\Models\District;
use App\Models\Practice;
use App\Models\Research;
use App\Models\Training;
use App\Mail\TrainingMail;
use App\Models\Testimonie;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReleaseComment;
use App\Models\ResearchTeacher;
use App\Models\LearningMaterial;
use App\Mail\ResearchTeacherMail;
use Illuminate\Support\Facades\DB;
use App\Models\CommunityDedication;
use App\Models\ResearchParticipant;
use App\Http\Controllers\Controller;
use App\Models\ResearchTeacherGuide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommunityDedicationMail;
use App\Models\CertificateClearenceLaboratory;
use App\Models\CommunityDedicationGuide;
use App\Models\ParticipantCommunityDedication;
use PDF;
class DashboardController extends Controller
{
    public function index()
    {   
        $trainings = Participant::where('user_id', Auth::user()->id)->count();
        $dedications = ParticipantCommunityDedication::where('user_id', Auth::user()->id)->count();
        $researchs = Research::where('user_id', Auth::user()->id)->count();

        return view('user.index', compact('trainings', 'dedications', 'researchs'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function profileEdit(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255'],
            'nim' => ['min:10'],
            'phone' => ['min:10'],
            'address' => ['min:5'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'nim.min' => 'NIM harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'address.min' => 'Alamat harus minimal 5 karakter',
        ]);

        User::findOrFail(Auth::user()->id)->update($request->all());

        $notification = array(
            'message' => 'Profile berhasil diupdate !',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function password()
    {
        $user = Auth::user()->id;
        return view('user.profile.password', compact('user'));
    }

    public function passwordEdit(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ],[
            'oldpassword.required' => 'password sebelumnya harus diisi',
            'password.required' => 'password baru harus diisi',
            'password.confirmed' => 'password tidak sama',
            'password.min' => 'password minimal 8 karakter'
        ]);

        $hashed = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashed)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('mahasiswa.logout');
        }else{
            return redirect()->back()->with('error', 'password sebelumnya tidak sesuai');
        }
    }

    public function image()
    {
        $user = Auth::user();
        return view('user.profile.image', compact('user'));
    }

    public function imageSubmit(Request $request)
    {
        $user = Auth::user();
        
        if($request->file('image')){

            if (file_exists(public_path($user->profile))) {
                @unlink($user->profile);
            }

            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user'),$fileName);
            $url = 'upload/user/' . $fileName;

            User::find($user->id)->update([
                'profile' => $url,
            ]);

            $notification = array(
                'message' => 'Image berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }
    }

    public function training()
    {
        // $trainings = DB::table('users')
        // ->join('participants', 'users.id', '=', 'participants.user_id')
        // ->join('trainings', 'participants.training_id', '=', 'trainings.id')
        // ->join('learning_materials', 'trainings.id', '=', 'learning_materials.training_id')
        // ->select('trainings.name', 'learning_materials.file', 'users.id', 'trainings.date', 'trainings.place', 'trainings.training_categories_id')
        // ->where('participants.user_id', Auth::user()->id)
        // ->get();

        $trainings = Participant::with('user', 'training')->where('user_id', Auth::user()->id)->get();
        return view('user.training.index', compact('trainings'));
    }

    public function trainingDetail($id)
    {
        $training = Training::findOrFail($id);
        $trainer = Trainer::where('training_id', $training->id)->first();
        $material = LearningMaterial::where('training_id', $training->id)->first();

        return view('user.training.detail', compact('training', 'trainer', 'material'));
    }

    public function trainingEnroll($id)
    {
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum mendaftar pelatihan !');
        }

        $training = Training::findOrFail($id);

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar | ' . $training->name . '';

        return view('frontend.training.enroll', compact('training', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function submit(Request $request, $id)
    {
        $requirement = $request->requirement;
        $wordRequirement = 'saya memahami dan akan mengikuti persyaratan pelatihan';

        if($requirement !== $wordRequirement){
            return redirect()->back()->with('error', 'pastikan anda menulis kalimat di atas dengan benar. Perhatikan huruf besar dan kecil !');
        }
   
        $training = Training::findOrFail($id);
        $available = Participant::where('training_id', $training->id)->count();

        if($available == $training->participants){
            $notification = array(
                'message' => 'Kuota pelatihan telah penuh, silahkan hubungi admin !',
                'alert-type' => 'error',
            );
    
            return redirect()->route('mahasiswa.pelatihan')->with($notification);
        }

        $participants = Participant::where(['user_id' => $request->user_id, 'training_id' => $id])->first();
        
        if($participants){

            $notification = array(
                'message' => 'Anda telah mendaftar untuk pelatihan ini !',
                'alert-type' => 'error',
            );
    
            return redirect()->route('mahasiswa.pelatihan')->with($notification);
        }
        
        Participant::create([
            'user_id' => $request->user_id,
            'training_id' => $id
        ]);
        
        $user = User::where('id', $request->user_id)->first();

        $data = [
            'title' => $training->name,
            'name' => $user->name,
            'place' => $training->place,
            'date' => $training->date,
            'whatsapp' => $training->whatsapp,
            'zoom' => $training->zoom,
        ];

        Mail::to($user->email)->send(new TrainingMail($data));

        $notification = array(
            'message' => 'Pendaftaran Pelatihan berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('mahasiswa.pelatihan')->with('complete', 'Selamat, pendaftaran anda berhasil. Kami telah mengirimkan email kepada anda yang berisi link pelatihan !');
    }

    public function comment(Request $request, $id)
    {   
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'Silahkan login terlebih dahulu untuk memberikan komentar !');
        }

        News::findOrFail($id);
        Comment::create([
            'user_id' => Auth::user()->id,
            'new_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function commentRelease(Request $request, $id)
    {   
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'Silahkan login terlebih dahulu untuk memberikan komentar !');
        }

        Release::findOrFail($id);
        ReleaseComment::create([
            'user_id' => Auth::user()->id,
            'release_id' => $id,
            'comment' => $request->comment,
        ]);

        $notification = array(
            'message' => 'Komentar berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function joins()
    {
        $participants = ParticipantCommunityDedication::with('dedication', 'dosen')->where('user_id', Auth::user()->id)->get();
        return view('user.community-dedication.joins', compact('participants'));
    }

    public function join($id)
    {
        $users = User::orderBy('name', 'ASC')->get();
        $dedication = CommunityDedication::findOrFail($id);
        $guide = CommunityDedicationGuide::where('community_dedication_id', $dedication->id)->first();
        $quota = ParticipantCommunityDedication::where('dedication_id', $id)->count();

        return view('user.community-dedication.join', compact('dedication', 'guide', 'users', 'quota'));
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
                'dosen' => Auth::user()->name,
                'name' => $dedication->name,
                'place' => $dedication->place,
                'date' => $dedication->date,
                'link' => 'http://127.0.0.1:8000/mahasiswa/pengabdian-masyarakat/lain/'.$dedication->id,
                'email' => $user->name,
            ];
    
            Mail::to($user->email)->send(new CommunityDedicationMail($data));

            $notification = array(
                'message' => 'Mahasiswa Berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->back()->with('complete', 'Mahasiswa berhasil ditambahkan, kami telah mengirimkan email kepada mahasiswa tersebut yang berisi info pengabdian !');

        }
    }

    public function dedicationEnroll($id)
    {
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum mendaftar pengabdian !');
        }
        
        $dedication = CommunityDedication::findOrFail($id);

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar | ' . $dedication->name . '';

        return view('frontend.community-dedication.enroll', compact('dedication', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function dedicationSubmit(Request $request, $id)
    {
        $requirement = $request->requirement;
        $wordRequirement = 'saya memahami dan akan mengikuti persyaratan pengabdian';

        if($requirement !== $wordRequirement){
            return redirect()->back()->with('error', 'pastikan anda menulis kalimat di atas dengan benar. Perhatikan huruf besar dan kecil !');
        }
   
        $dedication = CommunityDedication::findOrFail($id);
        $available = ParticipantCommunityDedication::where('dedication_id', $dedication->id)->count();

        if($available == $dedication->participants){
            $notification = array(
                'message' => 'Kuota pengabdian telah penuh, silahkan hubungi dosen ybs !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        $participants = ParticipantCommunityDedication::where(['user_id' => $request->user_id, 'dedication_id' => $id])->first();
        
        if($participants){

            $notification = array(
                'message' => 'Anda telah mendaftar untuk pengabdian ini !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }
        
        ParticipantCommunityDedication::create([
            'user_id' => $request->user_id,
            'dedication_id' => $id
        ]);
        
        $notification = array(
            'message' => 'Pendaftaran Pengabdian berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('mahasiswa.community.dedication.joins')->with($notification);
    }

    public function listResearchTeacher()
    {
        $participants = ResearchParticipant::with('research', 'dosen')->where('user_id', Auth::user()->id)->get();
        return view('user.research.joins', compact('participants'));
    }

    public function researchTeacherDetail($id)
    {
        $users = User::orderBy('name', 'ASC')->get();
        $research = ResearchTeacher::findOrFail($id);
        $guide = ResearchTeacherGuide::where('research_id', $research->id)->first();
        $quota = ResearchParticipant::where('research_id', $id)->count();

        return view('user.research.join', compact('research', 'guide', 'users', 'quota'));
    }

    public function participantsResearchStore(Request $request, $id)
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
                'dosen' => Auth::user()->name,
                'title' => $research->title,
                'date' => $research->date,
                'link' => 'http://127.0.0.1:8000/mahasiswa/penelitian/lain/'.$research->id,
                'email' => $user->name,
            ];
    
            Mail::to($user->email)->send(new ResearchTeacherMail($data));

            $notification = array(
                'message' => 'Mahasiswa Berhasil ditambahkan !',
                'alert-type' => 'success',
            );
    
            return redirect()->back()->with('complete', 'Mahasiswa berhasil ditambahkan, kami telah mengirimkan email kepada mahasiswa tersebut yang berisi info pelatihan !');

        }
    }

    public function researchEnroll($id)
    {
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum mendaftar penelitian !');
        }
        $research = ResearchTeacher::findOrFail($id);

        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar | ' . $research->title;

        return view('frontend.research.enroll', compact('research', 'title', 'contact', 'regency', 'district', 'village'));
    }

    public function finalTaskEnroll()
    {   
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar Penelitian Tugas Akhir';

        return view('frontend.final-task.index', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    public function internshipEnroll()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar Penelitian Magang';

        return view('frontend.internship.index', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    public function practice()
    {   
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar Praktikum';

        return view('frontend.practice.index', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    public function practiceEnroll(Request $request)
    {
        $user = User::where(['nim' => $request->nim, 'email' => $request->email])->first();

        if(empty($user)){
            $notification = [
                'message' => 'Data anda belum terdaftar di sistem kami, silahkan daftarkan akun terlebih dahulu !',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $request->validate([
            'name' => ['min:3'],
            'nim' => ['min:10'],
            'phone' => ['min:10'],
            'lesson' => ['min:5'],
            'description' => ['min:20'],
            'dosen' => ['min:5'],
            'day' => ['min:4'],
            'time' => ['max:4'],
        ],[
            'name.min' => 'Nama harus minimal 3 karakter',
            'nim.min' => 'NIM harus minimal 10 karakter',
            'phone.min' => 'No hp harus minimal 10 karakter',
            'lesson.min' => 'Mata Kulaih harus minimal 10 karakter',
            'dosen.min' => 'Nama Dosen penelitian harus minimal 5 karakter',
            'day,min' => 'Hari minimal 4 karakter',
            'time.max' => 'Waktu Maksimal 4 karakter',
        ]);

        Practice::create([
            'user_id' => $user->id,
            'lesson' => $request->lesson,
            'dosen' => $request->dosen,
            'day' => $request->day,
            'time' => $request->time
        ]);
    
        return redirect()->route('mahasiswa.praktikum')->with('complete', 'Pendaftaran praktikum berhasil !');
    }

    public function lesson()
    {
        $years = Practice::select(DB::raw('LEFT(`created_at`, 4) AS year'))
                            ->distinct()
                            ->get();
                            
        $practices = Practice::where('user_id', Auth::user()->id)->latest()->filter(request(['search']))->paginate(3)->withQueryString();
        return view('user.practice.index', compact('practices', 'years'));
    }

    public function researchIndividuEnroll()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar Penelitian Lain';

        return view('frontend.individual.index', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    public function researchSubmit(Request $request, $id)
    {
        $requirement = $request->requirement;
        $wordRequirement = 'saya memahami dan akan mengikuti persyaratan penelitian';

        if($requirement !== $wordRequirement){
            return redirect()->back()->with('error', 'pastikan anda menulis kalimat di atas dengan benar. Perhatikan huruf besar dan kecil !');
        }
   
        $dedication = ResearchTeacher::findOrFail($id);
        $available = ResearchParticipant::where('research_id', $dedication->id)->count();

        if($available == $dedication->participants){
            $notification = array(
                'message' => 'Kuota pelatihan telah penuh, silahkan hubungi dosen ybs !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        $participants = ResearchParticipant::where(['user_id' => $request->user_id, 'research_id' => $id])->first();
        
        if($participants){

            $notification = array(
                'message' => 'Anda telah mendaftar untuk pelatihan ini !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }
        
        ResearchParticipant::create([
            'user_id' => $request->user_id,
            'research_id' => $id
        ]);
        
        $notification = array(
            'message' => 'Pendaftaran Pelatihan berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('mahasiswa.penelitian.joins')->with($notification);
    }

    public function logout()
    {
        Auth::logout();

        $notification = array(
            'message' => 'Logout berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('login')->with($notification);
    }

    public function question(Request $request)
    {
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'Silahkan login terlebih dahulu untuk mengirimkan pesan !');
        }

        $message = Message::where('user_id', Auth::user()->id)->first();
        if($message){
            $replies = Reply::where('message_id', $message->id)->get();
            
            Reply::create([
                'message_id' => $message->id,
                'user_id' => Auth::user()->id,
                'message' => $request->message,
                'excerpt' => Str::limit(strip_tags($request->message), 200),
            ]);
    
            $notification = array(
                'message' => 'Pesan berhasil dikirim !',
                'alert-type' => 'success',
            );

            return redirect()->route('mahasiswa.message')->with($notification);
        }

        Message::create([
            'user_id' => Auth::user()->id,
            'message' => $request->message,
            'excerpt' => Str::limit(strip_tags($request->message), 200),
        ]);

        $notification = array(
            'message' => 'Pesan berhasil dikirim !',
            'alert-type' => 'success',
        );

        return redirect()->route('mahasiswa.message')->with($notification);

    }

    public function message()
    {
        $message = Message::where('user_id', Auth::user()->id)->first();
        if($message){
            $replies = Reply::where('message_id', $message->id)->get();
    
            return view('user.message.index', compact('message', 'replies'));
        }
        
        return view('user.message.blank');
    }

    public function reply(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        Reply::create([
            'message_id' => $message->id,
            'user_id' => Auth::user()->id,
            'message' => $request->message,
            'excerpt' => Str::limit(strip_tags($request->message), 200),
        ]);

        $notification = array(
            'message' => 'Pesan berhasil dikirim !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function testimoniUser(Request $request)
    {   
        if(!Auth::user()){
            return redirect()->route('login')->with('complete', 'silahkan login terlebih dahulu sebelum memberikan testimoni anda !');
        }

        Testimonie::create([
            'user_id' => Auth::user()->id,
            'testimoni' => $request->testimoni,
        ]);

        $notification = array(
            'message' => 'Terima Kasih telah memberikan testimoni anda !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function member()
    {   
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Daftar Member Lab';

        return view('user.member.index', compact('title', 'contact', 'regency', 'district', 'village'));
    }

    public function memberEnroll(Request $request)
    {   
        $requirement = $request->requirement;
        $wordRequirement = 'saya memahami dan akan mengikuti persyaratan member lab';

        if($requirement !== $wordRequirement){
            return redirect()->back()->with('error', 'pastikan anda menulis kalimat di atas dengan benar. Perhatikan huruf besar dan kecil !');
        }

        $check = User::where(['id' => Auth::user()->id, 'status' => 1])->first();

        if($check){
            $notification = array(
                'message' => 'Anda telah terdaftar',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }

        User::where('id', Auth::user()->id)->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Pendaftaran Member berhasil !',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);

    }

    public function certificateClearenceLaboratory()
    {
        $contact = Contact::find(1);
        $regency = Regency::where('id', $contact->regency_id)->first();
        $district = District::where('id', $contact->district_id)->first();
        $village = Village::where('id', $contact->village_id)->first();

        $title = 'Surat Keterangan Bebas Laboratorium';
        $user = Auth::user();

        return view('frontend.certificate-clearence-laboratory.index', compact('contact', 'regency', 'district', 'village', 'title', 'user'));
    }

    public function certificateClearenceLaboratorySubmit(Request $request)
    {
        $request->validate([
            'generation' => 'min:4',
            'title_of_thesis' => 'min:10',
            'dosen' => 'min:3',
            'necessity' => 'min:10',
            'kpm' => 'mimes:pdf',
            'form_ta' => 'mimes:pdf',
            'form_proposal' => 'mimes:pdf',
            'form_pengesahan_kp' => 'mimes:pdf',
            'form_kp' => 'mimes:pdf',
        ], [
            'generation.min' => 'Angkatan minimal 4 angka',
            'title_of_thesis.min' => 'Judul TA minimal 10 angka',
            'dosen.min' => 'Nama Dosen minimal 3 angka',
            'necessity.min' => 'Keperluan minimal 10 angka',
            'kpm.mimes' => 'KPM harus pdf',
            'form_ta.mimes' => 'Fotocopy Form Ujian TA harus pdf',
            'form_proposal.mimes' => 'Fotocopy Tanda Terima Proposal Proposal harus pdf',
            'form_pengesahan_kp.mimes' => 'Fotocopy Pengesahan KP harus pdf',
            'form_kp.mimes' => 'Fotocopy Laporan KP harus pdf',
        ]);

        $check = CertificateClearenceLaboratory::where('user_id', Auth::user()->id)->first();
        if($check == null){

                
            $file = $request->file('kpm');
            $destinationPath = 'upload/kpm';
            $kpm = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$kpm);

            $file = $request->file('form_ta');
            $destinationPath = 'upload/form_ta';
            $form_ta = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$form_ta);

            $file = $request->file('form_proposal');
            $destinationPath = 'upload/form_proposal';
            $form_proposal = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$form_proposal);

            $file = $request->file('form_pengesahan_kp');
            $destinationPath = 'upload/form_pengesahan_kp';
            $form_pengesahan_kp = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$form_pengesahan_kp);

            $file = $request->file('form_kp');
            $destinationPath = 'upload/form_kp';
            $form_kp = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$form_kp);

            CertificateClearenceLaboratory::create([
                'user_id' => Auth::user()->id,
                'generation' => $request->generation,
                'title_of_thesis' => $request->title_of_thesis,
                'dosen' => $request->dosen,
                'necessity' => $request->necessity,
                'basis_data' => $request->basis_data,
                'multimedia' => $request->multimedia,
                'robotika' => $request->robotika,
                'elektronika' => $request->elektronika,
                'perangkat_keras' => $request->perangkat_keras,
                'struktur_data' => $request->struktur_data,
                'pemrograman_lanjut' => $request->pemrograman_lanjut,
                'instrumen' => $request->instrumen,
                'kecerdasan' => $request->kecerdasan,
                'jaringan' => $request->jaringan,
                'pengolahan' => $request->pengolahan,
                'rpl' => $request->rpl,
                'pemrograman_dasar' => $request->pemrograman_dasar,
                'pemrograman_internet' => $request->pemrograman_internet,
                'kpm' => $kpm,
                'form_ta' => $form_ta,
                'form_proposal' => $form_proposal,
                'form_pengesahan_kp' => $form_pengesahan_kp,
                'form_kp' => $form_kp,
            ]);
            
            $notification = [
                'message' => 'Pengajuan SK Bebas Lab berhasil !',
                'alert-type' => 'success',
            ];

            return redirect()->route('mahasiswa.laboratory.clearance.certificate')->with($notification);
        }else{
            $notification = [
                'message' => 'Anda telah memeliki SK Bebas Laboratorium',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function certificateClearenceLaboratoryView()
    {
        $certificate = CertificateClearenceLaboratory::where('user_id', Auth::user()->id)->first();
        $options = CertificateClearenceLaboratory::select(DB::raw('
                                                                  basis_data, multimedia, robotika, elektronika, 
                                                                  perangkat_keras, struktur_data, pemrograman_lanjut, 
                                                                  instrumen, kecerdasan, jaringan, pengolahan, rpl, 
                                                                  pemrograman_dasar, pemrograman_internet'
                                                                ))->where('user_id', Auth::user()->id)->first();
                                                    
        return view('user.certificate-clearence-laboratory.index', compact('certificate','options'));
    }

    public function certificateClearenceLaboratoryBasisData($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.basis-data',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Basis-Data.pdf');
        }
    }

    public function certificateClearenceLaboratoryMultimedia($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.multimedia',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Multimedia.pdf');
        }
    }

    public function certificateClearenceLaboratoryRobotika($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.robotika',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Robotika.pdf');
        }
    }

    public function certificateClearenceLaboratoryElektronika($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.elektronika',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Elektronika.pdf');
        }
    }

    public function certificateClearenceLaboratoryPerangkatKeras($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.perangkat-keras',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Perangkat-Keras.pdf');
        }
    }

    public function certificateClearenceLaboratoryStrukturData($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.struktur-data',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Struktur-Date.pdf');
        }
    }

    public function certificateClearenceLaboratoryPemrogramanLanjut($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.pemrograman-lanjut',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Pemrograman-Lanjut.pdf');
        }
    }

    public function certificateClearenceLaboratoryInstrumen($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.instrumen',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Instrumen.pdf');
        }
    }

    public function certificateClearenceLaboratoryKecerdasan($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.kecerdasan',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Kecerdasan.pdf');
        }
    }

    public function certificateClearenceLaboratoryJaringan($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.jaringan',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Jaringan.pdf');
        }
    }

    public function certificateClearenceLaboratoryPengolahan($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.pengolahan',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Pengolahan.pdf');
        }
    }

    public function certificateClearenceLaboratoryRpl($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.rpl',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-RPL.pdf');
        }
    }

    public function certificateClearenceLaboratoryPemrogramanDasar($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.pemrograman-dasar',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Pemrograman-Dasar.pdf');
        }
    }

    public function certificateClearenceLaboratoryPemrogramanInternet($id)
    {   
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        if($certificate->status === 0)
        {   
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }elseif($certificate->status === 2){
            $notification = array(
                'message' => 'SK Bebas Lab belum tersedia',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $user = Auth::user();
    
            $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.pemrograman-internet',compact('user', 'certificate'))->setPaper('a4')->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('SK-Bebas-Lab-Pemrograman-Internet.pdf');
        }
    }

    public function kpm($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('user.certificate-clearence-laboratory.kpm', compact('certificate'));
    }

    public function laporanKp($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('user.certificate-clearence-laboratory.laporan-kp', compact('certificate'));
    }

    public function formUjianTa($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('user.certificate-clearence-laboratory.form-ujian-ta', compact('certificate'));
    }

    public function pengesahanKp($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('user.certificate-clearence-laboratory.pengesahan-kp', compact('certificate'));
    }

    public function tandaTerimaProposal($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('user.certificate-clearence-laboratory.tanda-terima-proposal', compact('certificate'));
    }

    public function formPengajuan($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);

        $user = Auth::user();
    
        // $pdf = PDF::loadView('frontend.certificate-clearence-laboratory.form-pengajuan',compact('user', 'certificate'))->setPaper('a4')->setOptions([
        //     'tempDir' => public_path(),
        //     'chroot' => public_path(),
        // ]);

        // return $pdf->download('Pengajuan-SK-Bebas-Lab.pdf');

        return view('frontend.certificate-clearence-laboratory.form-pengajuan', compact('user', 'certificate'));
    }
}
