@extends('asistant.layouts.main')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Galeri</h4>
                <p class="card-description">
                    Form Edit Galeri
                </p>
                <form method="POST" action="{{ route('asistant.gallery.update.image', $gallery->id) }}" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        @if ($galleries->count())
                            @foreach ($galleries as $image)
                                <div class="card mr-3 mb-3 ml-3" style="width: 20rem;">
                                    <img src="{{ asset($image->gambar) }}" class="card-img-top" style="width: 320px; height: 200px;">
                                    <div class="card-body" style="text-align: center">
                                    <a href="{{ route('asistant.gallery.delete.image',$image->id) }}">
                                        <i class="typcn typcn-trash" id="delete" title="Delete Image"></i>
                                    </a>
                                    <input class="mt-3" type="file" name="gambar[{{  $image->id}}]">
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('asistant.galleries') }}" class="btn btn-light mr-2">Cancel</a>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        @else
                            <p class="card-description ml-3">Galeri tidak ditemukan</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
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