@extends('frontend.layouts.main')
@section('main')
    @if(Auth::guard('web')->check())
        <div ata-scroll-index='1' class="admission_area">
            <div class="admission_inner">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-7">
                            <div class="admission_form">
                                <h3>Pendaftaran Praktikum</h3>
                                <form method="POST" action="{{ route('mahasiswa.daftar.praktikum') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="nim"  value="{{ old('nim', Auth::user()->nim) }}"placeholder="NIM" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Alamat Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="single_input">
                                                <div class="default-select" id="default-select">
                                                    <select name="jurusan">
                                                        <option value="Komputerisasi Akuntansi" >Komputerisasi Akuntansi</option>
                                                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                                        <option value="Sistem Komputer">Sistem Komputer</option>
                                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                                        <option value="Teknik Komputer Jaringan">Teknik Komputer</option>
                                                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="lesson" value="{{ old('lesson') }}" class="@error('lesson') is-invalid @enderror" placeholder="Mata Kuliah" required>
                                                @error('lesson')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="dosen" value="{{ old('dosen') }}" class="@error('dosen') is-invalid @enderror" placeholder="Dosen Pengajar" required>
                                                @error('dosen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="day" value="{{ old('day') }}" class="@error('day') is-invalid @enderror" placeholder="Hari" required>
                                                @error('day')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="time" value="{{ old('time') }}" class="@error('time') is-invalid @enderror" placeholder="Jam" required>
                                                @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="apply_btn">
                                                <button class="boxed-btn3" type="submit">Daftar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div ata-scroll-index='1' class="admission_area">
            <div class="admission_inner">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-7">
                            <div class="admission_form">
                                <h3>Pendaftaran Praktikum</h3>
                                <form method="POST" action="{{ route('mahasiswa.daftar.praktikum') }}">
                                    @csrf
                                    <p class="text-white">Silahkan login sebagai mahasiswa terlebih dahulu sebelum mendaftar !</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="nim"  value="{{ old('nim') }}"placeholder="NIM" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="single_input">
                                                <div class="default-select" id="default-select">
                                                    <select name="jurusan">
                                                        <option value="Komputerisasi Akuntansi">Komputerisasi Akuntansi</option>
                                                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                                        <option value="Sistem Komputer">Sistem Komputer</option>
                                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                                        <option value="Teknik Komputer Jaringan">Teknik Komputer</option>
                                                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="lesson" value="{{ old('lesson') }}" class="@error('lesson') is-invalid @enderror" placeholder="Mata Kuliah" required>
                                                @error('lesson')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="dosen" value="{{ old('dosen') }}" class="@error('dosen') is-invalid @enderror" placeholder="Dosen Pengajar" required>
                                                @error('dosen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="day" value="{{ old('day') }}" class="@error('day') is-invalid @enderror" placeholder="Hari" required>
                                                @error('day')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="time" value="{{ old('time') }}" class="@error('time') is-invalid @enderror" placeholder="Jam" required>
                                                @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="apply_btn">
                                                <button class="boxed-btn3" type="submit">Daftar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection