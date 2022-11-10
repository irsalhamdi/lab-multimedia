@extends('lead.layouts.main')
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
                    <img class="mb-3" src="https://source.unsplash.com/500x400?"{{ $release->category->name }}" style="display: block; margin-left: auto; margin-right: auto; width: 300px; height: 300px;"> 
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