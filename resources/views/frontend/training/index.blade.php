@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Pelatihan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($trainings->count())
        <section class="blog_area section-padding">
            <div class="container"> 
                <div class="row"> 
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">

                            @foreach ($trainings as $training)
                                @php
                                    $date = date('d',strtotime($training->date));
                                    $month = date('F',strtotime($training->date));
                                    $year = date('Y',strtotime($training->date));
                                    $hour = date('H:i',strtotime($training->date));
                                @endphp
                                <article class="blog_item">
                                    <div class="blog_item_img" style="width: 100%">
                                        <img class="card-img rounded-0" src="{{ asset($training->image) }}">
                                        <a href="{{ route('home.training', $training->id) }}" class="blog_item_date">
                                            <h3>{{ $date }}</h3>
                                            @php
                                                $date = date('F',strtotime($training->created_at))
                                            @endphp
                                            <p>{{ Str::substr($month, 0, 3) }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ route('home.training', $training->id) }}">
                                            <h2>{{ $training->name }}</h2>
                                        </a>
                                        <p>{!! Str::limit($training->description, 100) !!}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="{{ route('home.training.categories', $training->category->id) }}"><i class="fa fa-list"></i>{{ $training->category->name }}</a></li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach

                            <div class="d-flex justify-content-center">
                                {{ $trainings->links() }}
                            </div>

                        </div>
                    </div>
                    @include('frontend.components.sidebar-training')
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
                                <h3>Pelatihan tidak di temukan</h3>
                            </div>
                        </div>
                    </div>
                    @include('frontend.components.sidebar-training')
                </div>
            </div>
        </section>
    @endif
@endsection