@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Dosen</h4>
            <p class="card-description">
            Form Edit Dosen
            </p>
            <form method="POST" action="{{ route('asistant.dosen.update', $dosen->id) }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $dosen->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Dosen" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $dosen->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email Dosen" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" name="nip" value="{{ old('nip', $dosen->nip) }}" class="form-control @error('nip') is-invalid @enderror" placeholder="NIM Dosen" required>
                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="number" name="phone" value="{{ old('phone', $dosen->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="No Handphone Dosen" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $dosen->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat Dosen" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ route('asistant.dosen') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection