@extends('asistant.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Berita</h4>
            <p class="card-description">
            Form Tambah Berita
            </p>
            <form method="POST" action="{{ route('asistant.news.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Judul Berita">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="news_categories_id" class="form-control @error('news_categories_id') is-invalid @enderror" required>
                        <option value="" selected="" disabled="">
                            Pilih kategori berita
                        </option>
                        @foreach ($categories as $category)
                            @if (old('news_categories_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('news_categories_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <img id="showImage" src="{{ asset('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
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
                        {{ old('description') }}
                    </textarea>
                    @error('description')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
                </div>
            <a href="{{ route('asistant.news') }}" class="btn btn-light">Cancel</a>
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

