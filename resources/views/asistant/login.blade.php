@extends('login.main')
@section('form')
    <div class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Login Asisten Lab</h3>
                            @if (Session::has('error'))
                                <p>{{ session::get('error') }}</p>
                            @endif
                            <form method="POST" action="{{ route('asistant.login') }}">
                                @csrf
                                <div class="row">
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
                                            <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="apply_btn">
                                            <button class="boxed-btn3" type="submit">Masuk</button>
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