@extends('admin.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Mahasiswa</h4>
            <p class="card-description">
            Form Tambah Mahasiswa
            </p>
            <form method="POST" action="{{ route('admin.mahasiswa.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>NIM</label>
                    <input type="number" name="nim" value="{{ old('nim') }}" class="form-control @error('nim') is-invalid @enderror" placeholder="NIM Mahasiswa" required>
                    @error('nim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ route('admin.mahasiswa') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection