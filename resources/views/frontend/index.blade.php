@extends('frontend.layouts.main')
@section('main')
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text ">
                                <h3>Kegiatan pelatihan Lab <br>
                                    Multimedia Fasilkom  <br>
                                    UNSRI.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text ">
                                <h3>Kegiatan pelatihan Lab <br>
                                    Multimedia Fasilkom  <br>
                                    UNSRI.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text ">
                                <h3>Kegiatan pelatihan Lab <br>
                                    Multimedia Fasilkom <br>
                                    UNSRI.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service_area gray_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section_title text-center mb-70">
                        <h3 class="mb-45">Pelayanan</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-4 col-md-6">
                    <div class="single_service d-flex align-items-center ">
                        <div class="icon">
                            <i class="flaticon-school"></i>
                        </div>
                        <a href="{{ route('home.trainings') }}">
                            <div class="service_info">
                                <h4>Pelatihan</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service d-flex align-items-center ">
                        <div class="icon">
                            <i class="flaticon-error"></i>
                        </div>
                        <a href="{{ route('home.dedications') }}">
                            <div class="service_info">
                                <h4>Pengabdian</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service d-flex align-items-center ">
                        <div class="icon">
                            <i class="flaticon-book"></i>
                        </div>
                        <a href="{{ route('home.release') }}">
                            <div class="service_info">
                                <h4>Informasi</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popular_program_area section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section_title text-center mb-70">
                        <h3 class="mb-45">Berita Terkini</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $new)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__program">
                            <div class="program_thumb">
                                <img src="{{ asset($new->image) }}" style="width: 350px; height: 300px">
                            </div>
                            <div class="program__content">
                                @php
                                    $date = date('d',strtotime($new->date));
                                    $month = date('F',strtotime($new->date));
                                    $year = date('Y',strtotime($new->date));
                                    $hour = date('H:i',strtotime($new->date));
                                @endphp
                                <span>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}, {{ $hour }}</span>
                                <h4><a href="{{ route('home.news.detail', $new->id) }}">{{ $new->title }}</a></h4>
                                <p>{{ Str::limit($new->excerpt, 50) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_all_btn text-center">
                        <a href="{{ route('home.news') }}" class="boxed-btn4">Lihat Semua</a>
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="section_title text-center">
                        <h3>Pelatihan Terakhir</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($latest !== null)
        <div class="latest_coures_area">
            <div class="latest_coures_inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="coures_info">
                                <div class="section_title white_text">
                                    <h3>{{ Str::limit( $latest->name, 20) }}</h3>
                                    <div class="cotainer" style="padding: 5%">
                                        <p>{!! $latest->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif

    <div class="recent_event_area section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section_title text-center mb-70">
                        <h3 class="mb-45">Pelatihan Mendatang</h3>
                        <p>Lab Multimedia banyak mengadakan rangkaian kegiatan pelatihan yang menarik dan, bermanfaat untuk mahasiswa Fakultas Ilmu Komputer Universitas Sriwijaya.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @foreach ($trainings as $training)
                        <div class="single_event d-flex align-items-center">
                            <div class="date text-center">
                                @php
                                    $date = date('d',strtotime($training->date));
                                    $month = date('F',strtotime($training->date));
                                    $year = date('Y',strtotime($training->date));
                                    $hour = date('H:i',strtotime($training->date));
                                @endphp
                                <span>{{ $date }}</span>
                                <p>{{ $month }}{{","}} {{ $year }}</p>
                            </div>
                            <div class="event_info">
                                <a href="{{ route('home.training', $training->id) }}">
                                    <h4>{{ $training->name }}</h4>
                                </a>
                                <p>
                                    <span> <i class="flaticon-clock"></i> {{ $hour }} WIB</span> 
                                    <span> <i class="flaticon-calendar"></i> {{ $date }} {{ $month }} {{ $year }}</span> 
                                    <span> <i class="flaticon-placeholder"></i> {{ $training->place }}</span> 
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_all_btn text-center">
                        <a href="{{ route('home.trainings') }}" class="boxed-btn4">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent_news_area section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section_title text-center mb-70">
                        <h3 class="mb-45">Pengabdian Masyarakat</h3>
                        <p>Lihat berbagai info seputar pengabdian, pelatihan, dan penelitian yang tersedia di Fakultas Ilmu Komputer Universitas Sriwijaya.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($dedications as $dedication)
                    @php
                        $date = date('d',strtotime($dedication->date));
                        $month = date('F',strtotime($dedication->date));
                        $year = date('Y',strtotime($dedication->date));
                        $hour = date('H:i',strtotime($dedication->date));
                    @endphp
                    <div class="col-md-6">
                        <div class="single__news">
                            <div class="thumb">
                                <a href="single-blog.html">
                                    <img src="{{ asset($dedication->image) }}" style="width: 555px; height: 444px">
                                </a>
                                <span class="badge">Pengabdian Masyarakat</span>
                            </div>
                            <div class="news_info">
                                <a href="{{ route('home.dedication', $dedication->id) }}">
                                    <h4>{{ Str::limit($dedication->name, 35) }}</h4>
                                </a>
                                <p class="d-flex align-items-ce nter"> 
                                    <span> <i class="flaticon-clock"></i> {{ $date }} {{ Str::substr($month, 0, 3) }}, {{ $year }} WIB</span> 
                                    <span> <i class="ti-user"></i> {{ $dedication->dosen->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="course_all_btn text-center">
                        <a href="{{ route('home.dedications') }}" class="boxed-btn4">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection