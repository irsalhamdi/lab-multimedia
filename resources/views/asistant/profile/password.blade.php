@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Password</h4>
                <p class="card-description">
                Form Edit Password
                </p>
                <form method="POST" action="{{ route('asistant.password.submit') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>Password Sekarang</label>
                        <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" placeholder="Password Sekarang" required>
                        @error('oldpassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (Session::has('error'))
                            <p class="text-danger">
                                {{ Session::get('error') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('asistant.dashboard') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection