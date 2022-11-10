@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Mahasiswa</h4>
            <p class="card-description">
            Form Edit Mahasiswa
            </p>
            <form method="POST" action="{{ route('asistant.mahasiswa.update', $user->id) }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Mahasiswa" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email Mahasiswa" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="number" name="nim" value="{{ old('nim', $user->nim) }}" class="form-control @error('nim') is-invalid @enderror" placeholder="NIM Mahasiswa" required>
                    @error('nim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="number" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="No Handphone Mahasiswa" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Mahasiswa" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ route('asistant.mahasiswa') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection