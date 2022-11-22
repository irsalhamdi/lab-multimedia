@extends('frontend.layouts.main')
@section('main')
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Hasil Penelitian</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popular_program_area section__padding program__page">
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="container">
                    <div class="row">
                        @if ($results->count())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tema</th>
                                    <th scope="col">Peneliti</th>
                                    <th scope="col">Lihat</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($results as $result)
                                            <tr>
                                                <td scope="row">{{ $i++ }}</td>
                                                    @php
                                                        $research = App\Models\ResearchTeacher::where('id', $result->research_teacher_id)->first();
                                                    @endphp
                                                <td>{{ $research->title }}</td>
                                                <td>{{ $research->dosen->name }}</td>
                                                <td>
                                                    @if (Auth::user() && Auth::user()->email_verified_at !== null)
                                                        <a target="_blank" href="{{ asset('upload/research-teacher/result/'.$result->file) }}" class="genric-btn default-border circle arrow">
                                                            Lihat<span class="lnr lnr-arrow-right"></span>
                                                        </a>
                                                    @elseif(Auth::guard('dosen')->check())
                                                        <a target="_blank" href="{{ asset('upload/research-teacher/result/'.$result->file) }}" class="genric-btn default-border circle arrow">
                                                            Lihat<span class="lnr lnr-arrow-right"></span>
                                                        </a>
                                                    @else
                                                        Hanya tersedia untuk member lab
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-lg-12">
                                <div class="section_title text-center">
                                    <h4>Hasil penelitian belum tersedia</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection