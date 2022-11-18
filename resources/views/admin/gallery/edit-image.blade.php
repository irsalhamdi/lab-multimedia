@extends('admin.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Gambar Utama</h4>
            <p class="card-description">
            Form Edit Gambar Utama
            </p>
            <form method="POST" action="{{ route('admin.gallery.update.image', $gallery->id) }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <img id="showImage" src="{{ (!empty($gallery->image)) ? asset($gallery->image) : url('upload/default.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                </div>
                <div class="form-group">
                    <label>Gambar Utama</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" required>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="{{ route('admin.galleries') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Galeri</h4>
            <p class="card-description">
            Form Edit Galeri
            </p>
            <form method="POST" action="{{ route('admin.gallery.update.image', $gallery->id) }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="row row-sm">
                    @foreach ($galleries as $image)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset($image->gambar) }}" width="280" height="130">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="" class="btn btn-sm" id="delete" title="Delete Image">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <div class="form-group">
                                        <label class="form-control-label">Change Image</label>
                                        <input type="file" name="name[ $image->id ]" class="form-control">
                                    </div>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.galleries') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
    <script type="text/javascript">
            $(document).ready(function(){
                $('#multiImg').on('change', function(){
                    if (window.File && window.FileReader && window.FileList && window.Blob){
                        var data = $(this)[0].files;
               
                        $.each(data, function(index, file){
                            if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
    
                                var fRead = new FileReader();
                                fRead.onload = (function(file){
    
                                    return function(e) {
                                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80).height(80); 
                                        $('#preview_img').append(img);
                                    };
    
                                })(file);
    
                                fRead.readAsDataURL(file);
                            }
                        });
               
                    }else{
                        alert("Your browser doesn't support File API!");
                    }
                });
            });
    </script>
@endsection