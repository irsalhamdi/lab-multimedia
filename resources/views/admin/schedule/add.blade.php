@extends('admin.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Jadwal Harian</h4>
            <p class="card-description">
            Form Tambah Jadwal Harian
            </p>
            <form method="POST" action="{{ route('admin.schedule.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Mulai</label>
                    <input type="datetime-local" name="hour" value="{{ old('hour') }}" class="form-control @error('hour') is-invalid @enderror" placeholder="Waktu Mulai" required>
                    @error('hour')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Selesai</label>
                    <input type="datetime-local" name="endhour" value="{{ old('endhour') }}" class="form-control @error('endhour') is-invalid @enderror" placeholder="Waktu Selesai" required>
                    @error('endhour')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Dosen</label>
                    <input type="text" name="teacher" value="{{ old('teacher') }}" class="form-control @error('teacher') is-invalid @enderror" placeholder="Nama Dosen" required>
                    @error('teacher')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mata Kuliah</label>
                    <input type="text" name="lesson" value="{{ old('lesson') }}" class="form-control @error('lesson') is-invalid @enderror" placeholder="Mata Kuliah" required>
                    @error('lesson')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ route('admin.schedules') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection