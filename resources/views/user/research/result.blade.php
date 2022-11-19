@extends('user.layouts.main')
@section('main')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="row">
        <div class="col-md-6">
          <div class="card-body">
            <h4 class="card-title">Hasil Penelitian</h4>
            <p class="card-description">Upload hasil penelitian anda</p>
            @if ($result)
                <a target="_blank" href="{{ asset('upload/research/result/'.$result->file) }}">Download</a>
            @else
            @endif
          </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <form action="{{ route('mahasiswa.penelitian.individu.hasil.submit', $research->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if ($result)
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    @else
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    @endif
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection