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
}
