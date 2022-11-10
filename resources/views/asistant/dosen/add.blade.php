@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Dosen</h4>
            <p class="card-description">
            Form Tambah Dosen
            </p>
            <form method="POST" action="{{ route('asistant.dosen.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" name="nip" value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP Dosen" required>
                    @error('nip')
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