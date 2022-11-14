@extends('frontend.layouts.main')
@section('main')
    <div class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Pendaftaran Penelitian</h3>
                            <form method="POST" action="{{ route('mahasiswa.daftar.penelitian.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="nim" value="{{ old('nim', $user->nim) }}" placeholder="NIM" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Alamat Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nomor Handphone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" placeholder="Jurusan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror" placeholder="Tema penelitian" required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single_input">
                                            <input type="text" name="description" value="{{ old('description') }}" class="@error('description') is-invalid @enderror" placeholder="Deskripsi Penelitian" required>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single_input">
                                            <input type="text" name="dosen" value="{{ old('dosen') }}" class="@error('dosen') is-invalid @enderror" placeholder="Dosen pendamping" required>
                                            @error('dosen')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single_input">
                                            <input type="file" name="image" class="@error('image') is-invalid @enderror" placeholder="Surat Pengantar Penelitian" required>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="apply_btn">
                                                <p class="text-white">Upload Surat pengantar penelitian : file pdf</p>
                                            </div>
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
@endsection