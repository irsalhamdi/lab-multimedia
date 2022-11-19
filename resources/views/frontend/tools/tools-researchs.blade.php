@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Peralatan Laboratorium</h3>
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
                        <h3>Peralatan Penelitian</h3>
                    </div>
                    <form action="{{ route('home.tools') }}" class="mt-3 mb-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Peralatan" aria-label="Cari Peralatan">
                                <div class="input-group-append">
                                <button class="btn btn-sm btn-warning" type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if ($tools->count())
                    @foreach ($tools as $tool)
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                    <img src="{{ asset($tool->image) }}" style="width: 360; height: 268px;">
                                </div>
                                <div class="program__content">
                                    <div style="text-align: center">
                                        <i class="fa fa-bar-chart mr-3"></i>
                                        {{ $tool->quantity }}
                                    </div>
                                    <h4><a href="">{{ $tool->name }}</a></h4>
                                    <p>{!! $tool->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{ $tools->links() }}
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="section_title text-center">
                            <h4>Peralatan Laboratorium tidak temukan</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection