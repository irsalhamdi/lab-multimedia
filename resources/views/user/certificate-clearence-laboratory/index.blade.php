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
                                    Lihat
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
                                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                          Dokumen
                                        </a>
                                        <div class="dropdown-menu">
                                            <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.form.pengajuan', $certificate->id) }}" class="dropdown-item">
                                                <span class="card-description">Form Pengajuan</span>
                                            </a>
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
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                          Laboratorium
                                        </a>
                                        <div class="dropdown-menu">
                                            @if ($options['basis_data'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Basis Data</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['multimedia'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Multimedia</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['robotika'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Robotika</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['elektronika'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Elektronika</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['perangkat_keras'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Perangkat Keras</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['struktur_data'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Struktur Data</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['pemrograman_lanjut'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Pemrograman Lanjut</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['instrumen'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Instrumen</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['kecerdasan'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>BI</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['jaringan'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Jaringan</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['pengolahan'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Pengolahan</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['rpl'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>RPL</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['pemrograman_dasar'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Pemrograman Dasar</span>
                                                </a>
                                            @else
                                            @endif
                                            @if ($options['pemrograman_internet'] === 1)
                                                <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail', $certificate->id) }}" class="dropdown-item">
                                                    <span>Pemrograman Internet</span>
                                                </a>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection