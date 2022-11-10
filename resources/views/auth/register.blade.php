@extends('login.main')
@section('form')
    <div class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Pendaftaran Mahasiswa</h3>
                            @if (Session::has('error'))
                                {{ session::get('error') }}
                            @endif
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" class="@error('nim') is-invalid @enderror" required>
                                            @error('nim')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}" class="@error('nip') is-invalid @enderror" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="phone" placeholder="Nomor Handphone" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror" required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="address" placeholder="Alamat" value="{{ old('address') }}" class="@error('address') is-invalid @enderror" required>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="@error('password_confirmation') is-invalid @enderror" required>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="apply_btn">
                                            <p>Sudah mempunyai akun ? <a href="{{ route('login') }}" class="text-white"> Masuk</a> </p>
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
