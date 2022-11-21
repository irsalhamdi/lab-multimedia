@extends('dosen.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pengabdian Masyarakat</h4>
            <p class="card-description">
            Form Edit Pengabdian Masyarakat
            </p>
            <form method="POST" action="{{ route('dosen.community.dedication.update', $dedication->id) }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Skema</label>
                    <input type="text" name="skema" value="{{ old('skema', $dedication->skema) }}" class="form-control @error('skema') is-invalid @enderror" placeholder="Skema Pengabdian">
                    @error('skema')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $dedication->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pengabdian">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <input type="text" name="place" value="{{ old('place', $dedication->place) }}" class="form-control @error('place') is-invalid @enderror" placeholder="Tempat Pengabdian">
                    @error('place')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Waktu</label>
                    <input type="datetime-local" name="date" value="{{ old('date', $dedication->date) }}" class="form-control @error('date') is-invalid @enderror" placeholder="Waktu Pengabdian">
                    @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Anggota</label>
                    <input type="number" name="participants" value="{{ old('participants', $dedication->participants) }}" class="form-control @error('participants') is-invalid @enderror" placeholder="Jumlah Anggota">
                    @error('participants')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <img id="showImage" src="{{ (!empty($dedication->image)) ? asset($dedication->image) : url('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="editor" name="description" rows="10" cols="80" required>
                        {{ old('description', $dedication->description) }}
                    </textarea>
                    @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            <a href="{{ route('dosen.community.dedication') }}" class="btn btn-light">Cancel</a>
            <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

