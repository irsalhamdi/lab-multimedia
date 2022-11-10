@extends('frontend.layouts.main')
@section('main')
    <div class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Pendaftaran Pengabdian</h3>
                            <form method="POST" action="{{ route('mahasiswa.daftar.pengabdian.submit', $dedication->id) }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Alamat Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Nomor Handphone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="jurusan" value="{{ old('jurusan', Auth::user()->jurusan) }}" placeholder="Jurusan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Silahkan tulis, <span style="color: white">saya memahami dan akan mengikuti persyaratan pengabdian</span></p>
                                        @if (Session::has('error'))
                                            <p class="text-danger">
                                                {{ Session::get('error') }}
                                            </p>
                                        @endif
                                        <div class="single_input">
                                            <textarea cols="30" name="requirement" placeholder="Perjanjian" rows="10" required></textarea>
                                        </div>
                                        <p>Pastikan anda telah membaca peraturan dan persyaratan mengikuti pengabdian.</p>
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