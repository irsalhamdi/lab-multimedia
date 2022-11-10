@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row"> 
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Detail Berita</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset($new->image) }}">
                        </div>
                        <div class="blog_details">
                            <h2>{{ $new->title}}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="{{ route('home.news.categories', $new->category->id) }}"><i class="fa fa-list"></i> {{ $new->category->name }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> {{ $count }} Komentar</a></li>
                            </ul>
                            {!! $new->description !!}
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info"><span class="align-middle"><i class="fa fa-clock-o"></i></span> {{ $new->created_at}}</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> {{ $count }} Komentar</p> 
                            </div>
                            <ul class="social-icons">
                                <li><a target="_blank" href="{{ $shares['facebook'] }}"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a target="_blank" href="{{ $shares['twitter'] }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="{{ $shares['linkedin'] }}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="{{ $shares['whatsapp'] }}"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>{{ $count }} Komentar</h4>
                        @foreach ($comments as $comment)
                            @php
                                $date = date('d',strtotime($comment->created_at));
                                $month = date('F',strtotime($comment->created_at));
                                $year = date('Y',strtotime($comment->created_at));
                                $hour = date('H:i',strtotime($comment->created_at));
                            @endphp
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            @if($comment->admin_id !== null)
                                                <img src="{{ (!empty($comment->admin->profile)) ? asset($comment->admin->profile) : asset('frontend/img/user.png') }}" style="width: 70; height: 70; border-radius: 50%;">
                                            @elseif($comment->asistant_id !== null)
                                            <img src="{{ (!empty($comment->asistant->profile)) ? asset($comment->asistant->profile) : asset('frontend/img/user.png') }}" style="width: 70; height: 70; border-radius: 50%;">
                                            @elseif($comment->dosen_id !== null)
                                                <img src="{{ (!empty($comment->dosen->profile)) ? asset($comment->dosen->profile) : asset('frontend/img/user.png') }}" style="width: 70; height: 70; border-radius: 50%;">
                                            @elseif($comment->lead_id !== null)
                                                <img src="{{ (!empty($comment->lead->profile)) ? asset($comment->lead->profile) : asset('frontend/img/user.png') }}" style="width: 70; height: 70; border-radius: 50%;">
                                            @elseif($comment->user_id !== null)
                                                <img src="{{ (!empty($comment->user->profile)) ? asset($comment->user->profile) : asset('frontend/img/user.png') }}" style="width: 70; height: 70; border-radius: 50%;">
                                            @endif
                                        </div>
                                        <div class="desc">
                                            <p class="comment">
                                                {{ $comment->comment }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    @if($comment->admin_id !== null)
                                                        <a href="#">{{ $comment->admin->name }}</a>
                                                    @elseif($comment->asistant_id !== null)
                                                        <a href="#">{{ $comment->asistant->name }}</a>
                                                    @elseif($comment->dosen_id !== null)
                                                        <a href="#">{{ $comment->dosen->name }}</a>
                                                    @elseif($comment->lead_id !== null)
                                                        <a href="#">{{ $comment->lead->name }}</a>
                                                    @elseif($comment->user_id !== null)
                                                        <a href="#">{{ $comment->user->name }}</a>
                                                    @endif
                                                </h5>
                                                <p class="date">{{ $month }} {{ $date }}, {{ $year }} at {{ $hour }} WIB </p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="comment-form">
                        <h4>Tinggalkan Komentar</h4>
                        @if(Auth::guard('admin')->check())
                            <form method="POST" action="{{ route('admin.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">
                        @elseif(Auth::guard('asistant')->check())
                            <form method="POST" action="{{ route('asistant.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">
                        @elseif(Auth::guard('dosen')->check())
                            <form method="POST" action="{{ route('dosen.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">
                        @elseif(Auth::guard('lead')->check())
                            <form method="POST" action="{{ route('lead.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">
                        @elseif(Auth::guard('web')->check())
                            <form method="POST" action="{{ route('mahasiswa.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">
                        @elseif (!Auth::user())
                            <form method="POST" action="{{ route('mahasiswa.comment', $new->id) }}" class="form-contact comment_form" action="#" id="commentForm">  
                        @endif
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" required
                                        placeholder="Tulis Komentar"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
                @include('frontend.components.sidebar-news')
            </div>
        </div>
    </section>

    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
  
        });
    </script>
@endsection