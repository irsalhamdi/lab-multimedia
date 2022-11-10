@extends('asistant.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profil Lab</h4>
                <p class="card-description">
                Form Edit Profile Lab
                </p>
                <form method="POST" action="{{ route('asistant.vission.update') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>Visi</label>
                        <textarea id="editor" name="vission" rows="10" cols="80">
                            {!! old('vission', $profile->vission) !!}
                        </textarea>
                        @error('vission')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <a href="{{ route('asistant.dashboard') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection