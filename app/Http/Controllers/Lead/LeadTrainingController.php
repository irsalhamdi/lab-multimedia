<?php

namespace App\Http\Controllers\Lead;

use App\Models\Trainer;
use App\Models\Training;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\LearningMaterial;
use App\Models\TrainingCategory;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
use App\Exports\ParticipantsExport;

class LeadTrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('date', 'DESC')->filter(request(['search']))->paginate(3)->withQueryString();
        return view('lead.training.index', compact('trainings'));
    }

    public function create()
    {
        $categories = TrainingCategory::orderBy('name', 'ASC')->get();
        return view('lead.training.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_categories_id' => 'required',
            'name' => ['required', 'min:8', 'unique:trainings,name'],
            'description' => ['required', 'min:8'],
            'image' => ['required'],
            'participants' => ['required'],
            'place' => ['required', 'min:5'],
            'date' => 'required',
            'zoom' => ['required', 'min:10'],
            'whatsapp' => ['required', 'min:10'],
            'namapembicara' => ['required', 'min:3'],
            'imagePembicara' => ['required'],
            'job' => ['required'], 'min:5',
            'profile' => ['required', 'min:15']
        ], [
            'training_categories_id.required' => 'Kategori pelatihan wajib diisi',
            'name.required' => 'Nama pelatihan wajib diisi',
            'name.min' => 'Nama pelatihan minimal 8 karakter',
            'name.unique' => 'Nama pelatihan telah terdaftar di database',
            'description.required' => 'Deskripsi pelatihan wajib diisi',
            'description.min' => 'Deskripsi pelatihan minimal 8 karakter',
            'image.required' => 'Gambar pelatihan wajib diisi',
            'participants.required' => 'Peserta pelatihan wajib diisi',
            'place.required' => 'Tempat pelatihan pelatihan wajib diisi',
            'place.min' => 'Tempat pelatihan minimal 5 karakter',
            'date.required' => 'Waktu pelatihan pelatihan wajib diisi',
            'zoom.required' => 'Link zoom pelatihan wajib diisi',
            'zoom.min' => 'Link zoom pelatihan minimal 10 karakter',
            'whatsapp.required' => 'Link group whatsapp pelatihan wajib diisi',
            'whatsapp.min' => 'Link group whatsapp pelatihan minimal 10 karakter',
            'namapembicara.required' => 'Nama pembicara pelatihan wajib diisi',
            'namapembicara.min' => 'Nama pembicara pelatihan minimal 3 karakter',
            'job.required' => 'pekerjaan pembicara pelatihan wajib diisi',
            'job.min' => 'Pekerjaan pembicara pelatihan minimal 5 karakter',
            'imagePembicara.required' => 'Gambar pembicara pelatihan wajib diisi',
            'profile.required' => 'Profil pembicara pelatihan wajib diisi',
            'profile.min' => 'Profile pembicara pelatihan minimal 5 karakter',
        ]);

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/training'),$fileName);
            $url = 'upload/training/' . $fileName;

            $id = Training::insertGetId([
                'training_categories_id' => $request->training_categories_id,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $url,
                'participants' => $request->participants,
                'place' => $request->place,
                'date' => $request->date,
                'zoom' => $request->zoom,
                'whatsapp' => $request->whatsapp,
            ]);

            if($request->file('imagePembicara')){
                $file = $request->file('imagePembicara');
                $fileName = date('YmdHi'). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/trainer'),$fileName);
                $urlPembicara = 'upload/trainer/' . $fileName;

                Trainer::create([
                    'training_id' => $id,
                    'name' => $request->namapembicara,
                    'image' => $urlPembicara,
                    'job' => $request->job,
                    'profile' => $request->profile
                ]);
    
                $notification = array(
                    'message' => 'Pelatihan berhasil ditambahkan !',
                    'alert-type' => 'success',
                );
        
                return redirect()->route('lead.training')->with($notification);

            }else{
                $notification = array(
                    'message' => 'Image wajib diisi !',
                    'alert-type' => 'error',
                );
    
                return redirect()->back()->with($notification);
            }
        }else{

            $notification = array(
                'message' => 'Image wajib diisi !',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $trainer = Trainer::where('training_id', $training->id)->first();
        $categories = TrainingCategory::orderBy('name', 'ASC')->get();
        return view('lead.training.edit', compact('training', 'categories', 'trainer'));
    }

    public function updateForm(Request $request, $id)
    {   
        $request->validate([
            'training_categories_id' => 'required',
            'name' => ['required', 'min:8', 'unique:trainings,name'],
            'description' => ['required', 'min:8'],
            'participants' => ['required'],
            'place' => ['required', 'min:5'],
            'date' => 'required',
            'zoom' => ['required', 'min:10'],
            'whatsapp' => ['required', 'min:10'],
        ], [
            'training_categories_id.required' => 'Kategori pelatihan wajib diisi',
            'name.required' => 'Nama pelatihan wajib diisi',
            'name.min' => 'Nama pelatihan minimal 8 karakter',
            'name.unique' => 'Nama pelatihan telah terdaftar di database',
            'description.required' => 'Deskripsi pelatihan wajib diisi',
            'description.min' => 'Deskripsi pelatihan minimal 8 karakter',
            'participants.required' => 'Peserta pelatihan wajib diisi',
            'place.required' => 'Tempat pelatihan pelatihan wajib diisi',
            'place.min' => 'Tempat pelatihan minimal 5 karakter',
            'date.required' => 'Waktu pelatihan pelatihan wajib diisi',
            'zoom.required' => 'Link zoom pelatihan wajib diisi',
            'zoom.min' => 'Link zoom pelatihan minimal 10 karakter',
            'whatsapp.required' => 'Link group whatsapp pelatihan wajib diisi',
            'whatsapp.min' => 'Link group whatsapp pelatihan minimal 10 karakter',
        ]);

        Training::findOrFail($id)->update($request->all());

        $notification = array(
            'message' => 'Pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );
        
        return redirect()->route('lead.training')->with($notification);
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => ['required'],
        ], [
            'image.required' => 'Gambar pelatihan wajib diisi',
        ]);

        $training = Training::findOrFail($id);

        if($request->file('image')){

            if (file_exists(public_path($training->image))) {
                @unlink($training->image);
            }

            $file = $request->file('image');
            $fileName = $training->id .  date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/training'),$fileName);
            $url = 'upload/training/' . $fileName;

            Training::findOrFail($training->id)->update([
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Gambar Pelatihan berhasil diupdate !',
                'alert-type' => 'info',
            );
        
            return redirect()->route('lead.training')->with($notification);
        }
    }    

    public function updateFormTrainer(Request $request, $id)
    {
        $request->validate([
            'namapembicara' => ['required', 'min:3'],
            'job' => ['required'], 'min:5',
            'profile' => ['required', 'min:15']
        ], [
            'namapembicara.required' => 'Nama pembicara pelatihan wajib diisi',
            'namapembicara.min' => 'Nama pembicara pelatihan minimal 3 karakter',
            'job.required' => 'pekerjaan pembicara pelatihan wajib diisi',
            'job.min' => 'Pekerjaan pembicara pelatihan minimal 5 karakter',
            'profile.required' => 'Profil pembicara pelatihan wajib diisi',
            'profile.min' => 'Profile pembicara pelatihan minimal 5 karakter',
        ]);

        $trainer = Trainer::where('training_id', $id)->first();
        
        $trainer->update([
            'name' => $request->namapembicara,
            'profile' => $request->profile,
            'job' => $request->job
        ]);

        $notification = array(
            'message' => 'Pembicara pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );
        
        return redirect()->route('lead.training')->with($notification);
    }

    public function updateImageTrainer(Request $request, $id)
    {
        $request->validate([
            'imagePembicara' => ['required'],
        ], [
            'imagePembicara.required' => 'Gambar pembicara pelatihan wajib diisi',
        ]);

        $trainer = Trainer::where('training_id', $id)->first();

        if($request->file('imagePembicara')){

            if (file_exists(public_path($trainer->image))) {
                @unlink($trainer->image);
            }

            $file = $request->file('imagePembicara');
            $fileName = $trainer->id .date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/trainer'),$fileName);
            $url = 'upload/trainer/' . $fileName;

            $trainer->update([
                'image' => $url,
            ]);

            $notification = array(
                'message' => 'Gambar Pembicara pelatihan berhasil diupdate !',
                'alert-type' => 'info',
            );
        
            return redirect()->route('lead.training')->with($notification);
        }

        $notification = array(
            'message' => 'Gambar pembicara pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );
        
        return redirect()->route('lead.training')->with($notification);
    }

    public function show($id)
    {
        $training = Training::findOrFail($id);
        $trainer = Trainer::where('training_id', $id)->first();
        return view('lead.training.detail', compact('training', 'trainer'));
    }

    public function destroy($id)
    {   
        $training = Training::findOrFail($id);

        if(file_exists(public_path($training->image))){
            @unlink($training->image);
        }

        $trainer = Trainer::where('training_id', $id)->first();

        if(file_exists(public_path($trainer->image))){
            @unlink($trainer->image);
        }
        
        $material = LearningMaterial::where('training_id', $training->id)->first();
        if(file_exists(public_path('upload/training/material/'.$material->file))) {
            @unlink('upload/training/material/'.$material->file);
        }  

        $material->delete();
        $trainer->delete();
        Training::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Pelatihan berhasil dihapus !',
            'alert-type' => 'warning',
        );
        
        return redirect()->back()->with($notification);

    }

    public function learningMaterial($id)
    {   
        $training = Training::findOrFail($id);
        $material = LearningMaterial::where('training_id', $training->id)->first();
        return view('lead.training.learning-material', compact('training', 'material'));
    }

    public function uploadLearningMaterial(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:pdf,zip,png,jpg|max:2048',
        ],[
            'file.mimes' => 'tipe file harus pdf,zip, jpg atau png',
            'file.max' => 'file max 2048 MB',
        ]);

        $training = Training::findOrFail($id);
        $material = LearningMaterial::where('training_id', $training->id)->first();

        if($material){

            if(file_exists(public_path('upload/training/material/'.$material->file))) {
                @unlink('upload/training/material/'.$material->file);
            }            

            $file = $request->file('file');
            $destinationPath = 'upload/training/material';
            $name = $material->id .date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath,$name);

            LearningMaterial::findOrFail($material->id)->update([
                'file' => $name,
            ]);

            $notification = array(
                'message' => 'Materi pelatihan berhasil diupdate !',
                'alert-type' => 'info',
            );
    
            return redirect()->back()->with($notification);
        }

        $file = $request->file('file');
        $destinationPath = 'upload/training/material';
        $name = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath,$name);

        LearningMaterial::create([
            'training_id' => $training->id,
            'name' => $training->name,
            'file' => $name,
        ]);

        $notification = array(
            'message' => 'Materi pelatihan berhasil ditambahkan !',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function participants($id)
    {
        $participants = Participant::with('user')->where('training_id', $id)->get();
        $training = Training::findOrFail($id);
        return view('lead.training.participant', compact('participants', 'training'));
    }

    public function unactive(Request $request)
    {
        Training::findOrFail($request->id)->update([
            'status' => 0
        ]);
        
        $notification = array(
            'message' => 'Status pelatihan berhasil diupdate !',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    public function active(Request $request)
    {
        Training::findOrFail($request->id)->update([
            'status' => 1
        ]);
        
        $notification = array(
            'message' => 'Status pelatihan berhasil diupdate !',
            'alert-type' => 'info',
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
        $participant = Participant::findOrFail($id);
        $training = Training::where('id', $participant->training_id)->first();
        $name = $training->name.'xlsx';
        
        return $this->excel->download(new ParticipantsExport($id), $name);
    }
}
