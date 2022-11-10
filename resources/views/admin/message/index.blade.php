@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="comments-area">
            @foreach ($messages as $message)
                 @php
                    $date = date('d',strtotime($message->created_at));
                    $month = date('F',strtotime($message->created_at));
                    $year = date('Y',strtotime($message->created_at));
                    $hour = date('H:i',strtotime($message->created_at));
                @endphp
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
                                <img src="{{ (!empty($message->user->profile)) ? asset($message->user->profile) : url('upload/default.jpg') }}" style="width: 70; height: 70; border-radius: 50%;">
                            </div>
                            <div class="desc">
                                <p class="comment">{{ Str::limit($message->excerpt, 150) }}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h5>
                                            <a href="{{ route('admin.message.reply', $message->id) }}">{{ $message->user->name }}</a>
                                        </h5>
                                        <p class="date">{{ $month }} {{ $date }}, {{ $year }} at {{ $hour }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

