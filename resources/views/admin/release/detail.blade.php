@extends('admin.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($release->created_at));
        $month = date('F',strtotime($release->created_at));
        $year = date('Y',strtotime($release->created_at));
        $hour = date('H:i',strtotime($release->created_at));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $release->name }}</h4>
                <p class="card-description">
                    @if ($name == 'pdf')
                        <div class="container">
                            <p align="center">
                                <iframe type="application/pdf" src="{{ asset($release->file) }}" height="600" style="width: 100%;"></iframe>
                            </p>
                        </div>
                    @else
                        <img class="mb-3" src="{{ asset($release->file) }}" style="display: block; margin-left: auto; margin-right: auto; width: 100%; height: 100%;"> 
                    @endif
                    <i class="typcn typcn-time"></i> 
                    <code>
                        {{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}
                    </code>
                    <i class="typcn typcn-sort-alphabetically"></i> 
                    <code>
                        {{ $release->category->name }}
                    </code>
                </p> 
            {!! $release->description !!}
        </div>
        </div>
    </div>
@endsection