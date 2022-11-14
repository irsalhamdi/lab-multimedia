@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Jadwal</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($schedules as $schedule)
        <div class="whole-wrap">
            <div class="container box_1170 mb-5">
                <div class="section-top-border">
                    <div class="thumb">
                        <img src="{{ asset($schedule->image) }}" style="width: 100%;">
                    </div>
                    <h3 class="mt-3">{{ $schedule->name }}</h3>
                    <p class="sample-text mt-3">
                        {!! $schedule->description !!}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@endsection