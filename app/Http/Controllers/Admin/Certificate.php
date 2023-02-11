<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NumberCertificate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\CertificateClearenceLaboratoryMail;
use Illuminate\Support\Facades\Mail;
use App\Models\CertificateClearenceLaboratory;

class Certificate extends Controller
{
    public function index()
    {
        $certificates = CertificateClearenceLaboratory::latest()->paginate(3);
        return view('admin.certificate.index', compact('certificates'));
    }

    public function show($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        $user = User::where('id', $certificate->user_id)->first(); 

        // $pdf = PDF::loadView('admin.certificate.certificate',compact('user', 'certificate'))->setPaper('a4')->setOptions([
        //     'tempDir' => public_path(),
        //     'chroot' => public_path(),
        // ]);
        // return $pdf->download('SK-Bebas-Lab.pdf');

        return view('admin.certificate.certificate', compact('user', 'certificate'));
    }

    public function kpm($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('admin.certificate.kpm', compact('certificate'));
    }

    public function laporanKp($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('admin.certificate.laporan-kp', compact('certificate'));
    }

    public function formUjianTa($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('admin.certificate.form-ujian-ta', compact('certificate'));
    }

    public function pengesahanKp($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('admin.certificate.pengesahan-kp', compact('certificate'));
    }

    public function tandaTerimaProposal($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        return view('admin.certificate.tanda-terima-proposal', compact('certificate'));
    }

    public function formPengajuan($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);

        $user = User::where('id', $certificate->user_id)->first(); 
    
        // $pdf = PDF::loadView('admin.certificate.form-pengajuan',compact('user', 'certificate'))->setPaper('a4')->setOptions([
        //     'tempDir' => public_path(),
        //     'chroot' => public_path(),
        // ]);

        // return $pdf->download('Pengajuan-SK-Bebas-Lab.pdf');

        return view('admin.certificate.form-pengajuan', compact('user', 'certificate'));
    }

    public function acc($id)
    {
        $certificate = CertificateClearenceLaboratory::findOrFail($id);
        $check = NumberCertificate::select(DB::raw('number'))->where(['certificate_id' => $certificate->id, 'number' => NULL])->get();

        if(count($check) !== 0){
            $notification = array(
                'message' => 'Silahkan lengkapi semua nomor surat terlebih dahulu !',
                'alert-type' => 'error',
            );
    
            return redirect()->back()->with($notification);
        }else{
            $information = CertificateClearenceLaboratory::findOrFail($id)->update([
                'status' => 1,
            ]);
            
            $getUser = CertificateClearenceLaboratory::findOrFail($id);

            $user = User::findOrFail($getUser->user_id)->first();

            $data = [
                'name' => $user->name,
                'link' => 'http://127.0.0.1:8000/mahasiswa/surat-keterangan-bebas-laboratorium',
            ];
            
            Mail::to($user->email)->send(new CertificateClearenceLaboratoryMail($data));

            $notification = array(
                'message' => 'SK Bebas Lab berhasil di acc',
                'alert-type' => 'success',
            );
    
            return redirect()->back()->with($notification);
        }   
    }

    public function unacc($id)
    {
        CertificateClearenceLaboratory::findOrFail($id)->update([
            'status' => 2,
        ]);

        $notification = array(
            'message' => 'SK Bebas Lab berhasil di tolak',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    public function certificateVerifyNumber($id)
    {
        $information = CertificateClearenceLaboratory::findOrFail($id);
        $certificates = NumberCertificate::where('certificate_id', $id)->get();
        return view('admin.certificate.detail', compact(['information', 'certificates']));
    }
    
    public function certificateAddNumber($id)
    {
        $certificate = NumberCertificate::findOrFail($id);
        $information = CertificateClearenceLaboratory::where('id', $certificate->certificate_id)->first();
        
        return view('admin.certificate.add-number', compact(['certificate', 'information']));
    }

    public function certificateSubmitNumber(Request $request, $id)
    {
        $certificate = NumberCertificate::findOrFail($id);
        
        NumberCertificate::findOrFail($id)->update([
            'number' => $request->number,
            'upated_at' => Carbon::now(),
        ]);

        $information = CertificateClearenceLaboratory::where('id', $certificate->certificate_id)->first();

        $notification = array(
            'message' => 'Nomor Surat berhasil di update',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.laboratory.clearance.certificate.verify.number', $information->id)->with($notification);
    }

    public function certificateResult($id)
    {   
        $certificate = NumberCertificate::findOrFail($id);
        $information = CertificateClearenceLaboratory::where('id', $certificate->certificate_id)->first();
        $user = User::where('id', $information->user_id)->first();

        return view('admin.certificate.result', compact(['user', 'certificate', 'information']));
    }

}
