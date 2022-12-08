<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use PDF;
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

    public function acc($id)
    {
        CertificateClearenceLaboratory::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'SK Bebas Lab berhasil di acc',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
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

}
