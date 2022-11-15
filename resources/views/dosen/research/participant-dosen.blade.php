@extends('dosen.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <img class="mb-3" src="{{ asset($dosen->profile) }}" style="display: block; margin-left: auto; margin-right: auto; width: 260px; height: 260px;"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h4>Profile</h4>
                        <p>Nama    : {{ $dosen->name }} </p>
                        <p>Email   : {{ $dosen->email }}</p>
                        <p>NIP    : {{ $dosen->nip }}</p>
                        <p>Jurusan : {{ $dosen->jurusan }}</p>
                        <p>Alamat  : {{ $dosen->address }}</p>
                        <p>No HP   : {{ $dosen->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection