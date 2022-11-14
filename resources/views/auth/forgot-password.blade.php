@extends('frontend.layouts.main')
@section('main')
    <div class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Lupa Password</h3>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <p style="text-align: justify">
                                                lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirim email kepada Anda yang berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru. 
                                            </p>
                                        </p>
                                        @if (Session::has('status'))
                                            <p>{{ session::get('status') }}</p>
                                        @endif
                                        <div class="single_input">
                                            <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat Email" rows="10" required></textarea>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="apply_btn">
                                                <button class="boxed-btn3" type="submit">Submit</button>
                                            </div>
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
