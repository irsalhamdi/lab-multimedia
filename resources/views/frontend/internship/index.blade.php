@extends('frontend.layouts.main')
@section('main')
    <div ata-scroll-index='1' class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Pendaftaran Penelitian Magang</h3>
                            <form method="POST" action="{{ route('mahasiswa.daftar.penelitian.individu') }}" enctype="multipart/form-data">
                                @csrf
                                <p class="text-white">Silahkan login terlebih dahulu sebelum mendaftar !</p>
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
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Nomor Handphone" required>
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
                                    <div class="col-md-6 mb-3">
                                        <div class="single_input">
                                            <div class="default-select" id="default-select">
                                                <select name="category">
                                                    <option disabled>Jenis Penelitian</option>
                                                    <option value="Penelitian Magang">Penelitian Magang</option>
                                                    <option value="Penelitian Tugas Akhir">Penelitian Tugas Akhir</option>
                                                    <option value="Penelitian Lain">Penelitian Lain</option>
                                                </select>
                                            </div>
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
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="dosen" value="{{ old('dosen') }}" class="@error('dosen') is-invalid @enderror" placeholder="Dosen Pendamping" required>
                                            @error('dosen')
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