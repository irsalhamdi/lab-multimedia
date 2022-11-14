@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Struktur Organisasi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="event_details_area section__padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/causes/causes.png') }}">
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>Dr. Ali Ibrahim</h4>
                                </a>
                                <p>
                                    <span>Kepala Laboratorium</span>  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/irsal.jpeg') }}">
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>Cakro</h4>
                                </a>
                                <p>
                                    <span>Admin Laboratorium</span>  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/dea.jpeg') }}">
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>Dea Salsabilla</h4>
                                </a>
                                <p>
                                    <span>Asisten Laboratorium</span>  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/iwan.jpeg') }}">
                        </div>
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>Iwan Mandala</h4>
                                </a>
                                <p>
                                    <span>Asistent Laboratorium</span>  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection