@extends('admin.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Peralatan</h4>
            <p class="card-description">
            Form Tambah Peralatan
            </p>
            <form method="POST" action="{{ route('admin.tool.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror" placeholder="Jumlah Peralatan">
                    @error('quantity')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <img id="showImage" src="{{ (!empty($tool->image)) ? asset($tool->image) : url('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
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
            <a href="{{ route('admin.tools') }}" class="btn btn-light">Cancel</a>
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

