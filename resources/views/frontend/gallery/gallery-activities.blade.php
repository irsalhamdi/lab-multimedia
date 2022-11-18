@extends('frontend.layouts.main')
@section('main')
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }

        .container-gallery{
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 8%;
        }

        .gallery{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 30px;
        }
        .gallery img{
            width: 90%;
            height: 90%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/lightbox.css') }}">

    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Gallery</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popular_program_area section__padding program__page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>{{ $title }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-gallery">
            <div class="gallery">
                @foreach ($galleries as $gallery)
                    <a href="{{ asset($gallery->gambar) }}" data-lightbox="models">
                        <img src="{{ asset($gallery->gambar) }}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/lightbox-plus-jquery.js') }}"></script>
@endsection