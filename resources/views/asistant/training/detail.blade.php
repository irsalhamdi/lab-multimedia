@extends('asistant.layouts.main')
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
                    <img class="mb-3" src="https://source.unsplash.com/500x400?"{{ $training->category->name }}" style="display: block; margin-left: auto; margin-right: auto; width: 300px; height: 300px;"> 
                    {!! $training->description !!}
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="card-body">
                <h4 class="card-title">{{ $trainer->name }}</h4>
                <p class="card-description"><i class="typcn typcn-th-list-outline"></i> <code>{{ $trainer->job }}</code><i class="typcn typcn-video-outline"></i> <code> <a target="_blank" href="{{ $training->zoom }}">Zoom</a></code> <i class="typcn typcn-phone-outline"></i> <code><a target="_blank" href="{{ $training->whatsapp }}">Whatsapp</a></code> </p>
                <div class="template-demo">
                    <img class="mb-3" src="https://source.unsplash.com/500x400?"{{ $training->category->name }}" style="display: block; margin-left: auto; margin-right: auto; width: 300px; height: 300px;"> 
                    {{ $trainer->profile }}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection