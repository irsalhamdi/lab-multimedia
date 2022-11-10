@extends('user.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="comments-area">
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
                                        <span class="text-primary">
                                            {{ $message->user->name }}
                                        </span>
                                    </h5>
                                    <p class="date">
                                        {{ $month }} {{ $date }}, {{ $year }} at {{ $hour }} 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($replies as $reply)
                @php
                    $date = date('d',strtotime($reply->created_at));
                    $month = date('F',strtotime($reply->created_at));
                    $year = date('Y',strtotime($reply->created_at));
                    $hour = date('H:i',strtotime($reply->created_at));
                @endphp
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
                                @if ($reply->user_id === null)
                                    <img src="{{ (!empty($message->admin->profile)) ? asset($message->admin->profile) : url('upload/default.jpg') }}" style="width: 70; height: 70; border-radius: 50%;">
                                @else     
                                    <img src="{{ (!empty($message->user->profile)) ? asset($message->user->profile) : url('upload/default.jpg') }}" style="width: 70; height: 70; border-radius: 50%;">                            
                                @endif
                            </div>
                            <div class="desc">
                                <p class="comment">
                                    {!! $reply->message !!}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h5>
                                            <span class="text-primary" href="">
                                                @if ($reply->user_id === null)
                                                    {{ $reply->admin->name }}
                                                @else                                                    
                                                    {{ $reply->user->name }}
                                                @endif
                                            </span>
                                        </h5>
                                        <p class="date">
                                            {{ $month }} {{ $date }}, {{ $year }} at {{ $hour }} 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="comment-form">
                <h4>Balas</h4>
                <form method="POST" action="{{ route('mahasiswa.message.reply.submit',$message->id) }}" class="form-contact comment_form" id="commentForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="comment" cols="30" rows="9" required placeholder="Tulis Pesan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

