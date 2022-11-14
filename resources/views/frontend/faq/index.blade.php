@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>FAQ</h3>
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
                        <h3>Frequently Ask Question</h3>
                    </div>
                    @if ($faqs->count())
                        <div class="accordion mt-3" id="accordionExample">
                            @foreach ($faqs as $faq)
                                <div class="card">
                                    <div class="card-header bg-warning" id="heading{{ $faq->id }}">
                                        <h2 class="mb-0">
                                        <button class="btn text-left text-white" type="button" style="font-size: 12px" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->ask }}
                                        </button>
                                        </h2>
                                    </div>
                                    <div id="collapse{{ $faq->id }}" class="collapse show" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                                        <div class="card-body" style="font-size: 12px">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center">Faq belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection