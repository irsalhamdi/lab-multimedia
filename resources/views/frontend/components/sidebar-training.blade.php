<div class="col-lg-4">
    <div class="blog_right_sidebar">
        <aside class="single_sidebar_widget search_widget">
            <form action="{{ route('home.trainings') }}">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder='Cari Pelatihan'
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Cari Pelatihan'">
                        <div class="input-group-append">
                            <button class="btn" type="submit"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                    type="submit">Cari</button>
            </form>
        </aside>

        <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title">Kategori</h4>
            <ul class="list cat-list">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('home.training.categories', $category->id) }}" class="d-flex">
                            <p>{{ $category->name }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title">Pelatihan Terbaru</h3>
            @foreach ($recents as $recent)
                <div class="media post_item" style="width: 100%">
                    <img src="{{ asset($recent->image) }}" style="width: 50px; height: 50px;">
                    <div class="media-body">
                        <a href="{{ route('home.training', $recent->id) }}">
                            <h3>{{ $recent->name }}</h3>
                        </a>
                        <p>{{ $recent->date }}</p>
                    </div>
                </div>
            @endforeach
        </aside>

        <aside class="single_sidebar_widget tag_cloud_widget">
            <h4 class="widget_title">Tag Pelatihan</h4>
            <ul class="list">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('home.training.categories', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <aside class="single_sidebar_widget instagram_feeds">
            <h4 class="widget_title">Gambar Pelatihan</h4>
            <ul class="instagram_row flex-wrap">
                @foreach ($trainings as $training)
                    <li>
                        <a href="{{ route('home.training', $training->id) }}">
                            <img class="img-fluid" src="{{ asset($training->image) }}" style="width: 50px; height: 50px">
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <aside class="single_sidebar_widget newsletter_widget">
            <h4 class="widget_title">Berlangganan</h4>
            <form method="POST" action="{{ route('subscribe') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan email'" placeholder='Masukkan email' required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit"> 
                    Berlangganan
                </button>
            </form>
        </aside>
    </div>
</div>