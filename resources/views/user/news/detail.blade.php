@extends('user.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($news->date));
        $month = date('F',strtotime($news->date));
        $year = date('Y',strtotime($news->date));
        $hour = date('H:i',strtotime($news->date));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $news->title }}</h4>
            @if($news->video == null)
            @else
                 @php
                    $string = substr($news->video, 32);
                    $url = 'https://www.youtube.com/embed/'.$string;
                @endphp
                <div class="text-center">
                    <iframe style="width: 100%" width="560" height="315" src="{{ $url }}"></iframe>                                
                </div>
            @endif
                <p class="card-description">
                    <img class="mb-3" src="{{ asset($news->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 100%; height: 100%;"> 
                    <i class="typcn typcn-time"></i> 
                    <code>
                        {{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}
                    </code>
                    <i class="typcn typcn-sort-alphabetically"></i> 
                    <code>
                        {{ $news->category->name }}
                    </code>
                </p> 
            {!! $news->description !!}
        </div>
        </div>
    </div>
@endsection