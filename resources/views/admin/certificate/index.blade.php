@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab </h4>
                <p class="card-description">
                    Surat Keterangan Bebas Laboratorium
                </p>
                @if ($certificates->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                    <th>                                        
                                        Lihat
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificates as $certificate)
                                    <tr>
                                        <td class="py-1">
                                            {{ $certificate->user->name }}
                                        </td>
                                        <td>
                                            @if ($certificate->status === 0)
                                                <span class="card-description">Belum Acc </span>                                        
                                            @elseif($certificate->status === 1)
                                                <span class="text-success">Acc</span>                                   
                                            @else
                                                <span class="text-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="">
                                                    <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                      Dokumen
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a target="_blank" href="{{ route('admin.laboratory.clearance.certificate.form.pengajuan', $certificate->id) }}" class="dropdown-item">
                                                            <span class="card-description">Form Pengajuan</span>
                                                        </a>
                                                        <a href="{{ route('admin.laboratory.clearance.certificate.kpm', $certificate->id) }}" class="dropdown-item">
                                                            KPM
                                                        </a>
                                                        <a href="{{ route('admin.laboratory.clearance.certificate.laporan.kp', $certificate->id) }}" class="dropdown-item">
                                                            Laporan KP
                                                        </a>
                                                        <a href="{{ route('admin.laboratory.clearance.certificate.form.ujian.ta', $certificate->id) }}" class="dropdown-item">
                                                            Form Ujian TA
                                                        </a>
                                                        <a href="{{ route('admin.laboratory.clearance.certificate.pengesahan.kp', $certificate->id) }}" class="dropdown-item">
                                                            Pengesahan KP
                                                        </a>
                                                        <a href="{{ route('admin.laboratory.clearance.certificate.tanda.terima.proposal', $certificate->id) }}" class="dropdown-item">
                                                            Tanda Terima Proposal
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($certificate->status === 1)
                                                <div class="btn-group">
                                                    <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                        Aksi
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a id="year" onclick="submit()" type="submit" class="dropdown-item" href="{{ route('admin.laboratory.clearance.certificate.unacc', $certificate->id) }}">Un-Acc</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="btn-group">
                                                    <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                        Aksi
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a id="year" onclick="submit()" type="submit" class="dropdown-item" href="{{ route('admin.laboratory.clearance.certificate.acc', $certificate->id) }}">Acc</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.laboratory.clearance.certificate.verify.number', $certificate->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-eye-outline"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <p class="text-muted">SK Bebas Lab tidak di temukan</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $certificates->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection