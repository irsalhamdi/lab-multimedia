@extends('user.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-description">
                Form Edit Profile
                </p>
                <form method="POST" action="{{ route('mahasiswa.profile.submit') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nim</label>
                        <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" class="form-control @error('nim') is-invalid @enderror" placeholder="Nomor Induk Mahasiswa" disabled required>
                        @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" class="form-control @error('jurusan') is-invalid @enderror" placeholder="Jurusan" required>
                        @error('jurusan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="number" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor Handphone" required>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" required>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection