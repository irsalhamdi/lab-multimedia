@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Rilis</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($releases->count())
        <section class="blog_area section-padding">
            <div class="container"> 
                <div class="row"> 
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">

                            @foreach ($releases as $release)
                                @php
                                    $date = date('d',strtotime($release->created_at));
                                    $month = date('F',strtotime($release->created_at));
                                    $year = date('Y',strtotime($release->created_at));
                                    $hour = date('H:i',strtotime($release->created_at));
                                @endphp
                                <article class="blog_item">
                                    <div class="blog_item_img" style="width: 100%">
                                        @php
                                            $name = Str::substr($release->file, -3);
                                        @endphp
                                        @if ($name == 'pdf')
                                            <img class="card-img rounded-0" src="{{ asset('upload/default.jpg') }}">
                                        @else
                                            <img class="card-img rounded-0" src="{{ asset($release->file) }}">
                                        @endif
                                        <a href="{{ route('home.release.detail', $release->id) }}" class="blog_item_date">
                                            <h3>{{ $date }}</h3>
                                            @php
                                                $date = date('F',strtotime($release->created_at))
                                            @endphp
                                            <p>{{ Str::substr($month, 0, 3) }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ route('home.release.detail', $release->id) }}">
                                            <h2>{{ $release->name }}</h2>
                                        </a>
                                        <p>{!! Str::limit($release->description, 100) !!}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="{{ route('home.release.categories', $release->category->id) }}"><i class="fa fa-list"></i>{{ $release->category->name }}</a></li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach

                            <div class="d-flex justify-content-center">
                                {{ $releases->links() }}
                            </div>

                        </div>
                    </div>
                    @include('frontend.components.sidebar-release')
                </div>
            </div>
        </section>
    @else
        <section class="blog_area section-padding">
            <div class="container"> 
                <div class="row"> 
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                            <div class="d-flex justify-content-center">
                                <h3>Rilis tidak di temukan</h3>
                            </div>
                        </div>
                    </div>
                    @include('frontend.components.sidebar-release')
                </div>
            </div>
        </section>
    @endif
@endsection