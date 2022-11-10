@extends('frontend.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($training->date));
        $month = date('F',strtotime($training->date));
        $year = date('Y',strtotime($training->date));
        $hour = date('H:i',strtotime($training->date));
    @endphp

    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Detil Pelatihan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="event_details_area section__padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset($training->image) }}">
                            <div class="date text-center">
                                <h4>{{ $date }}</h4>
                                <span>{{ Str::substr($month, 0, 3) }}, {{ $year }}</span>
                            </div>
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>{{ $training->name }}</h4>
                                </a>
                                <p>
                                    <span> <i class="flaticon-clock"></i> {{ $hour }} WIB</span>  
                                    <span> <i class="flaticon-placeholder"></i> {{ $training->place }}</span><br>
                                    <span style="padding-top: 5%;">
                                        <span> 
                                            <a target="_blank" href="{{ $shares['facebook'] }}">
                                                <i class="fa fa-facebook-f"></i>
                                            </a>
                                        </span>
                                        <span> 
                                            <a target="_blank" href="{{ $shares['twitter'] }}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </span>
                                        <span> 
                                            <a target="_blank" href="{{ $shares['whatsapp'] }}">
                                                <i class="fa fa-whatsapp"></i>
                                            </a>
                                        </span>
                                        <span> 
                                            <a target="_blank" href="{{ $shares['linkedin'] }}">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </span>
                                    </span> 
                                </p>
                            </div>
                            <p class="event_info_text">{!! $training->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset($trainer->image) }}">
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>{{ $trainer->name }}</h4>
                                </a>
                            </div>
                            <span class="event_info_text">{{ $trainer->job }}</span>
                            <p class="event_info_text">{{ $trainer->profile }}</p>
                            @if ($training->status === 1)
                                <a href="{{ route('mahasiswa.daftar.pelatihan', $training->id) }}" class="boxed-btn3">Daftar</a>
                            @else
                                <a href="#" class="boxed-btn3">Pendaftaran telah ditutup</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection