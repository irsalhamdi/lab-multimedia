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
    <div class="popular_program_area section__padding program__page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height: 300px;" src="{{ asset('frontend/img/causes/causes.png') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Kepala Laboratorium <br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Dr. Ali Ibrahim</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height:300px;" src="{{ asset('frontend/img/cakro.jpg') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Admin Laboratorium Palembang<br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Cakro</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height:300px; " src="{{ asset('frontend/img/hafez.jpg') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Admin Laboratorium Indaralaya<br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Nabila</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height:300px;" src="{{ asset('frontend/img/dea.jpg') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Asisten Laboratorium Palembang<br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Dea Salsabila</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height:300px; " src="{{ asset('frontend/img/iwan.jpg') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Asisten Laboratorium Palembang<br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Iwan Mandala Putra</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="single__program">
                        <div class="program_thumb" style="text-align: center">
                            <img style="border: 4px; border-radius: 10px; width: 300px; height:300px;" src="{{ asset('frontend/img/tasya.jpg') }}">
                        </div>
                        <div class="program__content">
                            <div style="text-align: center">
                                Asisten Laboratorium Palembang<br>
                                <b style="font-family: Poppins; color: #ffb804; font-size: 20px;">Tassya Ushwatun Hasanah</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection