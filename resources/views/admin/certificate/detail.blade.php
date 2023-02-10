@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab - {{ $information->user->name }}</h4>
                <p class="card-description">
                    Daftar Surat Keterangan Bebas Laboratorium
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Laboratorium
                                </th>
                                <th>
                                    Aksi
                                </th>
                                <th>                                        
                                    Hasil
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certificates as $certificate)
                                <tr>
                                    <td class="py-1">
                                        @if ($certificate->type === 'basis_data')
                                            Basis Data
                                        @elseif($certificate->type === 'multimedia')
                                            Multimedia
                                        @elseif($certificate->type === 'robotika')
                                            Robotika
                                        @elseif($certificate->type === 'elektronika')
                                            Elektronika
                                        @elseif($certificate->type === 'perangkat_keras')
                                            Perangkat Keras
                                        @elseif($certificate->type === 'struktur_data')
                                            Struktur Data
                                        @elseif($certificate->type === 'pemrograman_lanjut')
                                            Pemrograman Lanjut
                                        @elseif($certificate->type === 'instrumen')
                                            Instrumen
                                        @elseif($certificate->type === 'kecerdasan')
                                            BI
                                        @elseif($certificate->type === 'jaringan')
                                            Jaringan
                                        @elseif($certificate->type === 'pengolahan')
                                            Pengolahan
                                        @elseif($certificate->type === 'rpl')
                                            RPL
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.laboratory.clearance.certificate.add.number', $certificate->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-edit"></i>                                            
                                        </a>
                                    </td>
                                    <td>
                                        @if ($information->status !== 1)
                                            <span class="card-description">Belum Tersedia </span>                                              
                                        @else
                                            <a target="_blank" href="{{ route('admin.laboratory.clearance.certificate.result', $certificate->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-eye-outline"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.laboratory.clearance.certificate') }}" class="btn btn-light">Back</a>
            </div>
        </div>
    </div>
@endsection