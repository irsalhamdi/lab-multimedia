@extends('frontend.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($dedication->date));
        $month = date('F',strtotime($dedication->date));
        $year = date('Y',strtotime($dedication->date));
        $hour = date('H:i',strtotime($dedication->date));
    @endphp
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
    <div class="whole-wrap">
		<div class="container box_1170 mb-5">
            <div class="section-top-border">
                <div class="thumb">
                    <img src="{{ asset($dedication->image) }}" style="width: 100%;">
                </div>
                <h3 class="mt-3">{{ $dedication->name }}</h3>
                <p class="d-flex align-items-ce nter"> 
                    <span class="mr-2">
                        <i class="flaticon-clock"></i>
                        {{ $date }} {{ Str::substr($month, 0, 3) }}, {{ $year }} 
                    </span>
                    <span class="mr-2"> 
                        <i class="ti-user"></i>
                        <a href="{{ route('home.dosen', $dedication->dosen->id) }}">
                            {{ $dedication->dosen->name }} 
                        </a> 
                    </span>
                    <span class="mr-2"> 
                        <i class="flaticon-placeholder"></i>
                         {{ $dedication->place }} 
                    </span>
                    <span class="mr-2"> 
                        <i class="flaticon-book"></i> {{ $dedication->participants }} 
                    </span>
                </p>
                <div class="col-md-12">
                </div>
                <ul class="social-icons text-center mt-3">
                    <span class="mr-3"><a target="_blank" href="{{ $shares['facebook'] }}"><i class="fa fa-facebook-f"></i></a></span>
                    <span class="mr-3"><a target="_blank" href="{{ $shares['twitter'] }}"><i class="fa fa-twitter"></i></a></span>
                    <span class="mr-3"><a target="_blank" href="{{ $shares['linkedin'] }}"><i class="fa fa-linkedin"></i></a></span>
                    <span class="mr-3"><a target="_blank" href="{{ $shares['whatsapp'] }}"><i class="fa fa-whatsapp"></i></a></span>
                </ul>
                <p class="sample-text mt-3">
                    {!! $dedication->description !!}
                </p>
                <div style="float: right;">
                    @php
                        $now = date('Y-m-d');
                        $date = substr($dedication->date, 0, 10);
                    @endphp
                    @if ($now > $date)
                        <button class="boxed-btn3 text-right">Pendaftaran Ditutup</button>
                    @else
                        <a href="{{ route('mahasiswa.daftar.pengabdian', $dedication->id) }}" class="boxed-btn3 text-right">Daftar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection