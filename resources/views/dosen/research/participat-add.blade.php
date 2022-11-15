@extends('dosen.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Mahasiswa</h4>
            <p class="card-description">
            Form Tambah Mahasiswa
            </p>
            <form method="POST" action="{{ route('dosen.penelitian.participants.store', $research->id) }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Mahasiswa</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                        <option value="" selected="" disabled="">
                            Pilih mahasiswa
                        </option>
                        @foreach ($users as $user)
                            @if (old('user_id') == $user->id)
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="{{ route('dosen.penelitian.participants', $research->id) }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Dosen</h4>
            <p class="card-description">
            Form Tambah Dosen
            </p>
            <form method="POST" action="{{ route('dosen.penelitian.participants.store', $research->id) }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Dosen</label>
                    <select name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                        <option value="" selected="" disabled="">
                            Pilih dosen
                        </option>
                        @foreach ($dosens as $dosen)
                            @if (old('dosen_id') == $dosen->id)
                                <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}</option>
                            @else
                                <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('dosen_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="{{ route('dosen.penelitian.participants', $research->id) }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection