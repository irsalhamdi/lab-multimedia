@extends('dosen.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <img class="mb-3" src="{{ empty($user->profile) ? asset('frontend/img/user.png') : asset($user->profile) }}" style="display: block; margin-left: auto; margin-right: auto; width: 260px; height: 260px;"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h4>Profile</h4>
                        <p>Nama    : {{ $user->name }} </p>
                        <p>Email   : {{ $user->email }}</p>
                        <p>NIM     : {{ $user->nim }}</p>
                        <p>Jurusan : {{ $user->jurusan }}</p>
                        <p>Alamat  : {{ $user->address }}</p>
                        <p>No HP   : {{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection