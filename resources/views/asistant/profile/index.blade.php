@extends('asistant.layouts.main')
@section('main')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Profile</h4>
            <p class="card-description">
            Form Edit Profile
            </p>
            <form method="POST" action="{{ route('asistant.profile.submit') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $asistant->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{ old('email', $asistant->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" required>
                    @error('email')
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