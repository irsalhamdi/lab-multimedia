@extends('user.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($training->date));
        $month = date('F',strtotime($training->date));
        $year = date('Y',strtotime($training->date));
        $hour = date('H:i',strtotime($training->date));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <h4 class="card-title">{{ $training->name }}</h4>
                        <p class="card-description">
                            <i class="typcn typcn-location-outline"></i> 
                            <code>{{ $training->place }}</code> 
                            <i class="typcn typcn-user"></i> 
                            <code>{{ $training->participants }}</code> 
                            <i class="typcn typcn-time"></i> 
                            <code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code> 
                        </p>
                        <div class="template-demo">
                            <img class="mb-3" src="{{ asset($training->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 280px; height: 280px;"> 
                            {!! $training->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h4 class="card-description">{{ $trainer->name }}</h4>
                        <p class="card-description"><i class="typcn typcn-th-list-outline"></i> <code>{{ $trainer->job }}</code><i class="typcn typcn-video-outline"></i> <code> <a target="_blank" href="{{ $training->zoom }}">Zoom</a></code> <i class="typcn typcn-phone-outline"></i> <code><a target="_blank" href="{{ $training->whatsapp }}">Whatsapp</a></code> </p>
                        <div class="template-demo">
                            <img class="mb-3" src="{{ asset($trainer->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 300px; height: 300px;"> 
                            {{ $trainer->profile }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <h4 class="card-title">Materi pelatihan</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-description">Download Materi Pelatihan</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <img src="{{ asset('backend/images/download.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        @if ($material)
                            <a target="_blank" href="{{ asset('upload/training/material/'.$material->file) }} " class="btn btn-primary btn-rounded mr-2" style="">Unduh</a>
                        @else
                            <p>Materi pelatihan belum tersedia</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection