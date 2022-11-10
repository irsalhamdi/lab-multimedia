@extends('admin.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Rilis</h4>
                <p class="card-description">
                Form Tambah Rilis
                </p>
                <form method="POST" action="{{ route('admin.release.store') }}" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Rilis">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="release_categories_id" class="form-control @error('release_categories_id') is-invalid @enderror">
                            <option value="" selected="" disabled="">
                                Pilih kategori rilis
                            </option>
                            @foreach ($categories as $category)
                                @if (old('release_categories_id') == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('release_categories_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        @error('description')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                        <textarea id="editor" name="description" rows="10" cols="80">
                            {{ old('description') }}
                        </textarea>
                    </div>
                    <a href="{{ route('admin.release') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

