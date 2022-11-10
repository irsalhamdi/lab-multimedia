@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($news->count())
        <section class="blog_area section-padding">
            <div class="container"> 
                <div class="row"> 
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">

                            @foreach ($news as $new)
                                <article class="blog_item">
                                    <div class="blog_item_img" style="width: 100%">
                                        <img class="card-img rounded-0" src="{{ asset($new->image) }}">
                                        <a href="{{ route('home.news.detail', $new->id) }}" class="blog_item_date">
                                            <h3>{{ $new->created_at->format('d') }}</h3>
                                            @php
                                                $date = date('F',strtotime($new->created_at))
                                            @endphp
                                            <p>{{ Str::substr($date, 0, 3) }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ route('home.news.detail', $new->id) }}">
                                            <h2>{{ $new->title }}</h2>
                                        </a>
                                        <p>{{ $new->excerpt }}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="{{ route('home.news.categories', $new->news_categories_id) }}"><i class="fa fa-list"></i>{{ $new->category->name }}</a></li>
                                            @php
                                                $count = App\Models\Comment::where('new_id', $new->id)->get()->count();
                                            @endphp
                                            <li><a href="{{ route('home.news.detail', $new->id) }}"><i class="fa fa-comments"></i> {{ $count }} Comments</a></li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach

                            <div class="d-flex justify-content-center">
                                {{ $news->links() }}
                            </div>
                            
                        </div>
                    </div>
                    @include('frontend.components.sidebar-news')
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
                                <h3>Kategori Berita belum tersedia</h3>
                            </div>
                        </div>
                    </div>
                    @include('frontend.components.sidebar-news')
                </div>
            </div>
        </section>
    @endif
@endsection