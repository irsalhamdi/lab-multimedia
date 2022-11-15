@extends('dosen.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($research->date));
        $month = date('F',strtotime($research->date));
        $year = date('Y',strtotime($research->date));
        $hour = date('H:i',strtotime($research->date));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="card-title">{{ $research->title }}</h4>
                        <p class="card-description">
                            <i class="typcn typcn-user"></i> 
                            <code>{{ $research->participants }}</code> 
                            <i class="typcn typcn-time"></i> 
                            <code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code> 
                        </p>
                        <div class="template-demo">
                            <img class="mb-3" src="{{ asset($research->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 260px; height: 260px;"> 
                            {!! $research->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection