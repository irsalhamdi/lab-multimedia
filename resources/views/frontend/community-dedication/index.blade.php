@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Pengabdian Masyarakat</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popular_program_area section__padding program__page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>Pengabdian Masyarakat</h3>
                    </div>
                    <form action="{{ route('home.dedications') }}" class="mt-3 mb-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Pengabdian" aria-label="Cari Pengabdian">
                                <div class="input-group-append">
                                <button class="btn btn-sm btn-warning" type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if ($dedications->count())
                @foreach ($dedications as $dedication)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__program">
                            <div class="program_thumb">
                                <img src="{{ asset($dedication->image) }}" style="width: 360; height: 268px;">
                            </div>
                            <div class="program__content">
                                <span>
                                    <a href="{{ route('home.dosen', $dedication->dosen->id) }}">{{ $dedication->dosen->name }}</a>
                                </span>
                                <h4><a href="{{ route('home.dedication', $dedication->id) }}">{{ $dedication->name }}</a></h4>
                                <p>{{ $dedication->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container">
                    <div class="d-flex justify-content-center">
                        {{ $dedications->links() }}
                    </div>
                </div>
                @else
                    <div class="col-lg-12">
                        <div class="section_title text-center">
                            <h4>Pengabdian Masyarakat di temukan</h4>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection