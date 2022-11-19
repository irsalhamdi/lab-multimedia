@extends('frontend.layouts.main')
@section('main')    
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $title }}</h3>
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
                        <h3>Penelitian</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($researchs as $research)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__program">
                            <div class="program_thumb">
                                <img src="{{ asset($research->image) }}" style="width: 360; height: 268px;">
                            </div>
                            <div class="program__content">
                                <span>
                                    <i class="ti-user"></i>
                                    <a href="{{ route('home.dosen', $research->dosen->id) }}">
                                    {{ $research->dosen->name }}</a>
                                </span>
                                <h4><a href="{{ route('home.research', $research->id) }}">{{ $research->title }}</a></h4>
                                <p>{{ $research->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>Pengabdian Masyarakat</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($dedications as $dedication)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__program">
                            <div class="program_thumb">
                                <img src="{{ asset($dedication->image) }}" style="width: 360; height: 268px;">
                            </div>
                            <div class="program__content">
                                <span>
                                    <i class="ti-user"></i>
                                    <a href="{{ route('home.dosen', $dedication->dosen->id) }}">
                                    {{ $dedication->dosen->name }}</a>
                                </span>
                                <h4><a href="{{ route('home.dedication', $dedication->id) }}">{{ $dedication->name }}</a></h4>
                                <p>{{ $dedication->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>Berita</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($news as $new)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__program">
                            <div class="program_thumb">
                                <img src="{{ asset($new->image) }}" style="width: 360; height: 268px;">
                            </div>
                            <div class="program__content">
                                <span>
                                    <i class="ti-user"></i>
                                    <a href="{{ route('home.dosen', $new->dosen->id) }}">
                                    {{ $new->dosen->name }}</a>
                                </span>
                                <h4><a href="{{ route('home.news.detail', $new->id) }}">{{ $new->title }}</a></h4>
                                <p>{{ $new->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection