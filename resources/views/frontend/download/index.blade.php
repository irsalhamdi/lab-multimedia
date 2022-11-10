@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Unduhan</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popular_program_area section__padding program__page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="custom_tabs text-center">
                        <div class="nav" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Materi Pelatihan</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Rilis </a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="container">
                        <div class="row">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unduh</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($trainings as $training)
                                        <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $training->name }}</td>
                                        <td>
                                            <a target="_blank" href="{{ asset('upload/training/material/'.$training->file) }}" class="genric-btn default-border circle arrow">
                                                Unduh<span class="lnr lnr-arrow-right"></span>
                                            </a>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="container">
                        <div class="row">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unduh</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($releases as $release)
                                        <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $release->name }}</td>
                                        <td>
                                            <a target="_blank" href="{{ asset($release->file) }}" class="genric-btn default-border circle arrow">
                                                Unduh<span class="lnr lnr-arrow-right"></span>
                                            </a>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection