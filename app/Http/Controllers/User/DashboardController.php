<?php

namespace App\Http\Controllers\User;

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
use App\Models\CommunityDedication;
use App\Models\ResearchParticipant;
use App\Http\Controllers\Controller;
use App\Models\ResearchTeacherGuide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommunityDedicationMail;
use App\Models\CommunityDedicationGuide;
use App\Models\ParticipantCommunityDedication;

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
}
