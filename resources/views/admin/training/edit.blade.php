@extends('admin.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Image</h4>
                <p class="card-description">
                Form Edit Image
                </p>
                <form method="POST" action="{{ route('admin.training.update.image', $training->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img id="showImage" src="{{ (!empty($training->image)) ? asset($training->image) : url('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('admin.training') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Image Pembicara</h4>
                <p class="card-description">
                Form Edit Image Pembicara
                </p>
                <form method="POST" action="{{ route('admin.training.update.image.trainer', $training->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img id="showPembicara" src="{{ (!empty($trainer->image)) ? asset($trainer->image) : url('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="imagePembicara" class="form-control @error('imagePembicara') is-invalid @enderror" id="pembicara">
                        @error('imagePembicara')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('admin.training') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pelatihan</h4>
            <p class="card-description">
            Form Edit Pelatihan
            </p>
            <form method="POST" action="{{ route('admin.training.update.form', $training->id) }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name', $training->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pelatihan">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="training_categories_id" class="form-control @error('training_categories_id') is-invalid @enderror">
                        <option value="" selected="" disabled="">
                            Pilih kategori pelatihan
                        </option>
                        @foreach ($categories as $category)
                            @if (old('training_categories_id', $training->training_categories_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('training_categories_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="editor" name="description" rows="10" cols="80">
                        {!! old('description', $training->description) !!}
                    </textarea>
                    @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Peserta</label>
                    <input type="number" name="participants" value="{{ old('participants', $training->participants) }}" class="form-control @error('participants') is-invalid @enderror" placeholder="Jumlah Peserta">
                    @error('participants')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <input type="text" name="place" value="{{ old('place', $training->place) }}" class="form-control @error('place') is-invalid @enderror" placeholder="Lokasi Pelatihan">
                    @error('place')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Waktu</label>
                    <input type="datetime-local" name="date" value="{{ old('date', $training->date) }}" class="form-control @error('date') is-invalid @enderror" placeholder="Waktu Pelatihan">
                    @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Zoom</label>
                    <input type="text" name="zoom" value="{{ old('zoom', $training->zoom) }}" class="form-control @error('zoom') is-invalid @enderror" placeholder="Link Zoom Pelatihan">
                    @error('zoom')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Whats App</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $training->whatsapp) }}" class="form-control @error('whatsapp') is-invalid @enderror" placeholder="Link Whats App Group Pelatihan">
                    @error('whatsapp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="{{ route('admin.training') }}" class="btn btn-light">Cancel</a>
                <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pembicara</h4>
            <p class="card-description">
            Form Edit Pembicara
            </p>
            <form method="POST" action="{{ route('admin.training.update.form.trainer', $training->id) }}">
                @csrf
                <div class="form-group">
                    <label>Pembicara</label>
                    <input type="text" name="namapembicara" value="{{ old('namapembicara', $trainer->name) }}" class="form-control @error('namapembicara') is-invalid @enderror" placeholder="Nama Pembicara">
                    @error('namapembicara')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <input type="text" name="job" value="{{ old('job', $trainer->job) }}" class="form-control @error('job') is-invalid @enderror" placeholder="Pekerjaan Pembicara">
                    @error('job')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Profil</label>
                    <textarea name="profile" class="form-control" rows="10" cols="80">
                        {{ old('profile', $trainer->profile) }}
                    </textarea>
                    @error('profile')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <a href="{{ route('admin.training') }}" class="btn btn-light">Cancel</a>
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
        $(document).ready(function(){
            $('#pembicara').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showPembicara').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

