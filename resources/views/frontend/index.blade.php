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
                            <div class="program_thumb" style="overflow: hidden; border: 4px; border-radius: 5px;">
                                <img src="{{ asset($new->image) }}" style="width: 422px; height: 314px; object-fit: cover; object-position: 50% 50%">
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
            <div class="row" style="padding-top: 3%">
                <div class="col-lg-12">
                    <div class="course_all_btn text-center">
                        <a href="{{ route('home.news') }}" class="boxed-btn4">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div ata-scroll-index='1' class="admission_area">
        <div class="admission_inner">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-7">
                        <div class="admission_form">
                            <h3>Pendaftaran Penelitian</h3>
                            <form method="POST" action="{{ route('mahasiswa.daftar.penelitian.individu') }}" enctype="multipart/form-data">
                                @csrf
                                <p class="text-white">Silahkan login terlebih dahulu sebelum mendaftar !</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="nim"  value="{{ old('nim') }}"placeholder="NIM" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Nomor Handphone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="single_input">
                                            <div class="default-select" id="default-select">
                                                <select name="jurusan">
                                                    <option value="Komputerisasi Akuntansi">Komputerisasi Akuntansi</option>
                                                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                                    <option value="Sistem Komputer">Sistem Komputer</option>
                                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                                    <option value="Teknik Komputer Jaringan">Teknik Komputer</option>
                                                    <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="single_input">
                                            <div class="default-select" id="default-select">
                                                <select name="category">
                                                    <option disabled>Jenis Penelitian</option>
                                                    <option value="Penelitian Tugas Akhir">Penelitian Tugas Akhir</option>
                                                    <option value="Penelitian Magang">Penelitian Magang</option>
                                                    <option value="Penelitian Lain">Penelitian Lain</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror" placeholder="Tema penelitian" required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single_input">
                                            <input type="text" name="dosen" value="{{ old('dosen') }}" class="@error('dosen') is-invalid @enderror" placeholder="Dosen Pendamping" required>
                                            @error('dosen')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single_input">
                                            <input type="text" name="description" value="{{ old('description') }}" class="@error('description') is-invalid @enderror" placeholder="Deskripsi Penelitian" required>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single_input">
                                            <input type="file" name="image" class="@error('image') is-invalid @enderror" placeholder="Surat Pengantar Penelitian" required>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="apply_btn">
                                                <p class="text-white">Upload Surat pengantar penelitian : file pdf</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="apply_btn">
                                            <button class="boxed-btn3" type="submit">Daftar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                    <span> <i class="ti-user"></i>
                                        <a href="{{ route('home.dosen', $dedication->dosen->id) }}">{{ $dedication->dosen->name }}</a> 
                                    </span>
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

    <section class="testimonials-section" style="padding-bottom: 10%">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section_title text-center mb-70">
                        <h3 class="mb-45">Testimoni</h3>
                        <p>Lihat berbagai pengalaman mereka yang telah bekerja sama dengan kami</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js" type="text/javascript"></script>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel slide" data-ride="carousel" id="quote-carousel">    
                                <ol class="carousel-indicators">
                                    @if ($testimonies->count())
                                        <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                                        @php
                                            $counter = 1;
                                        @endphp
                                        @foreach ($testimonies->skip(1) as $testimoni)
                                            <li data-target="#quote-carousel" data-slide-to="{{ $counter++ }}"></li>
                                        @endforeach
                                    @else
                                    @endif
                                </ol>
                                <div class="carousel-inner">
                                    @if ($testimonies->count())
                                        <div class="item active">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @if($testimonies[0]->admin_id !== null)
                                                        <img src="{{ (!empty($testimonies[0]->admin->profile)) ? asset($testimonies[0]->admin->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                    @elseif($testimonies[0]->asistant_id !== null)
                                                        <img src="{{ (!empty($testimonies[0]->asistant->profile)) ? asset($testimonies[0]->asistant->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                    @elseif($testimonies[0]->dosen_id !== null)
                                                        <img src="{{ (!empty($testimonies[0]->dosen->profile)) ? asset($testimonies[0]->dosen->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                    @elseif($testimonies[0]->lead_id !== null)
                                                        <img src="{{ (!empty($testimonies[0]->lead->profile)) ? asset($testimonies[0]->lead->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                    @elseif($testimonies[0]->user_id !== null)
                                                        <img src="{{ (!empty($testimonies[0]->user->profile)) ? asset($testimonies[0]->user->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 70; border-radius: 50%;">
                                                    @endif
                                                    <p>
                                                        @if($testimonies[0]->admin_id !== null)
                                                            {{ $testimonies[0]->testimoni }}
                                                        @elseif($testimonies[0]->asistant_id !== null)
                                                            {{ $testimonies[0]->asitestimoni }}
                                                        @elseif($testimonies[0]->dosen_id !== null)
                                                            {{ $testimonies[0]->testimoni }}
                                                        @elseif($testimonies[0]->lead_id !== null)
                                                            {{ $testimonies[0]->testimoni }}
                                                        @elseif($testimonies[0]->user_id !== null)
                                                            {{ $testimonies[0]->testimoni }}
                                                        @endif
                                                    </p>
                                                    <small>
                                                        <strong>
                                                            <h5>
                                                                @if($testimonies[0]->admin_id !== null)
                                                                    <a href="#">{{ $testimonies[0]->admin->name }}</a>
                                                                @elseif($testimonies[0]->asistant_id !== null)
                                                                    <a href="#">{{ $testimonies[0]->asistant->name }}</a>
                                                                @elseif($testimonies[0]->dosen_id !== null)
                                                                    <a href="#">{{ $testimonies[0]->dosen->name }}</a>
                                                                @elseif($testimonies[0]->lead_id !== null)
                                                                    <a href="#">{{ $testimonies[0]->lead->name }}</a>
                                                                @elseif($testimonies[0]->user_id !== null)
                                                                    <a href="#">{{ $testimonies[0]->user->name }}</a>
                                                                @endif
                                                            </h5>
                                                        </strong>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($testimonies->skip(1) as $testimoni)
                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if($testimoni->admin_id !== null)
                                                            <img class="mb-3" src="{{ (!empty($testimoni->admin->profile)) ? asset($testimoni->admin->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                        @elseif($testimoni->asistant_id !== null)
                                                            <img class="mb-3" src="{{ (!empty($testimoni->asistant->profile)) ? asset($testimoni->asistant->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                        @elseif($testimoni->dosen_id !== null)
                                                            <img class="mb-3" src="{{ (!empty($testimoni->dosen->profile)) ? asset($testimoni->dosen->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                        @elseif($testimoni->lead_id !== null)
                                                            <img class="mb-3" src="{{ (!empty($testimoni->lead->profile)) ? asset($testimoni->lead->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 150px; border-radius: 50%;">
                                                        @elseif($testimoni->user_id !== null)
                                                            <img class="mb-3" src="{{ (!empty($testimoni->user->profile)) ? asset($testimoni->user->profile) : asset('frontend/img/user.png') }}" style="width: 150px; height: 70; border-radius: 50%;">
                                                        @endif
                                                    <p>
                                                        @if($testimoni->admin_id !== null)
                                                            {{ $testimoni->testimoni }}
                                                        @elseif($testimoni->asistant_id !== null)
                                                            {{ $testimoni->asitestimoni }}
                                                        @elseif($testimoni->dosen_id !== null)
                                                            {{ $testimoni->testimoni }}
                                                        @elseif($testimoni->lead_id !== null)
                                                            {{ $testimoni->testimoni }}
                                                        @elseif($testimoni->user_id !== null)
                                                            {{ $testimoni->testimoni }}
                                                        @endif
                                                    </p>
                                                    <small>
                                                        <strong>
                                                            <h5>
                                                                @if($testimoni->admin_id !== null)
                                                                    <a href="#">{{ $testimoni->admin->name }}</a>
                                                                @elseif($testimoni->asistant_id !== null)
                                                                    <a href="#">{{ $testimoni->asistant->name }}</a>
                                                                @elseif($testimoni->dosen_id !== null)
                                                                    <a href="#">{{ $testimoni->dosen->name }}</a>
                                                                @elseif($testimoni->lead_id !== null)
                                                                    <a href="#">{{ $testimoni->lead->name }}</a>
                                                                @elseif($testimoni->user_id !== null)
                                                                    <a href="#">{{ $testimoni->user->name }}</a>
                                                                @endif
                                                            </h5>
                                                        </strong>
                                                    </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-lg-12">
                                            <div class="section_title text-center">
                                                <h4>Testimoni belum tersedia</h4>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 5%">
                <div class="col-lg-12">
                    <div class="course_all_btn text-center">
                        <a href="{{ route('home.testimonies') }}" class="boxed-btn4">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 