@extends('dosen.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($dedication->date));
        $month = date('F',strtotime($dedication->date));
        $year = date('Y',strtotime($dedication->date));
        $hour = date('H:i',strtotime($dedication->date));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="card-title">{{ $dedication->name }}</h4>
                        <p class="card-description">
                            <i class="typcn typcn-location-outline"></i> 
                            <code>{{ $dedication->place }}</code> 
                            <i class="typcn typcn-user"></i> 
                            <code>{{ $dedication->participants }}</code> 
                            <i class="typcn typcn-time"></i> 
                            <code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code> 
                        </p>
                        <div class="template-demo">
                            <img class="mb-3" src="{{ asset($dedication->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 260px; height: 260px;"> 
                            {!! $dedication->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection