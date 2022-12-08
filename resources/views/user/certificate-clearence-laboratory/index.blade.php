@extends('user.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab</h4>
                <p class="card-description">
                    Surat Keterangan Bebas Laboratorium
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Surat 
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    SK Bebas Lab
                                </td>
                                <td>
                                    @if ($certificate->status === 0)
                                       <span class="card-description">Sedang ditinjau admin </span>                                        
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
                                                <a href="{{ route('mahasiswa.laboratory.clearance.certificate.kpm', $certificate->id) }}" class="dropdown-item">
                                                    KPM
                                                </a>
                                                <a href="{{ route('mahasiswa.laboratory.clearance.certificate.laporan.kp', $certificate->id) }}" class="dropdown-item">
                                                    Laporan KP
                                                </a>
                                                <a href="{{ route('mahasiswa.laboratory.clearance.certificate.form.ujian.ta', $certificate->id) }}" class="dropdown-item">
                                                    Form Ujian TA
                                                </a>
                                                <a href="{{ route('mahasiswa.laboratory.clearance.certificate.pengesahan.kp', $certificate->id) }}" class="dropdown-item">
                                                    Pengesahan KP
                                                </a>
                                                <a href="{{ route('mahasiswa.laboratory.clearance.certificate.tanda.terima.proposal', $certificate->id) }}" class="dropdown-item">
                                                    Tanda Terima Proposal
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                        <i class="typcn typcn-eye-outline"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection