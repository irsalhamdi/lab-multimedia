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
                        <div class="faq_area section_padding_130" id="faq">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-sm-10 col-lg-8">
                                        <div class="accordion faq-accordian" id="faqAccordion">
                                            @foreach ($faqs as $faq)
                                                <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                    <div class="card-header" id="headingOne">
                                                        <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">{{ $faq->ask }}<span class="lni-chevron-up"></span></h6>
                                                    </div>
                                                    <div class="collapse" id="collapse{{ $faq->id }}" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                                        <div class="card-body">
                                                            <p>{{ $faq->answer }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="support-button text-center d-flex align-items-center justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                            <i class="lni-emoji-sad"></i>
                                            <p class="mb-0 px-2">Tidak menemukan jawaban ?</p>
                                            <a href="{{ route('contact') }}"> Kontak kami</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-center">Faq belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection