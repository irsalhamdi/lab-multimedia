@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab - {{ $information->user->name }} - 
                    @if ($certificate->type === 'basis_data')
                        Laboratorium Basis Data
                    @elseif($certificate->type === 'multimedia')
                        Laboratorium Multimedia
                    @elseif($certificate->type === 'robotika')
                        Laboratorium Robotika
                    @elseif($certificate->type === 'elektronika')
                        Laboratorium Elektronika
                    @elseif($certificate->type === 'perangkat_keras')
                        Laboratorium Perangkat Keras
                    @elseif($certificate->type === 'struktur_data')
                        Laboratorium Struktur Data
                    @elseif($certificate->type === 'pemrograman_lanjut')
                        Laboratorium Pemrograman Lanjut
                    @elseif($certificate->type === 'instrumen')
                        Laboratorium Instrumen
                    @elseif($certificate->type === 'kecerdasan')
                        Laboratorium BI
                    @elseif($certificate->type === 'jaringan')
                        Laboratorium Jaringan
                    @elseif($certificate->type === 'pengolahan')
                        Laboratorium Pengolahan
                    @elseif($certificate->type === 'rpl')
                        Laboratorium RPL
                    @endif
                </h4>
                <p class="card-description">
                    Nomor Surat Keterangan Bebas Laboratorium
                </p>
                <div class="table-responsive">
                    <form method="POST" action="{{ route('admin.laboratory.clearance.certificate.submit.number', $certificate->id) }}" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="number" value="{{ old('number', $certificate->number) }}" class="form-control @error('number') is-invalid @enderror" placeholder="Masukkan Nomor Surat" required>
                        </div>
                        <a href="{{ route('admin.laboratory.clearance.certificate.verify.number', $information->id) }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection