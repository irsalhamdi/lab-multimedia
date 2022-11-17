@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Testimoni</h3>
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
                        <h3>Testimoni Mereka</h3>
                    </div>
                </div>
            </div>
            <div style="padding-bottom: 100px">
                <div class="row">
                    @if ($testimonies->count())
                        @foreach ($testimonies as $testimoni)
                            @php
                                $date = date('d',strtotime($testimoni->created_at));
                                $month = date('F',strtotime($testimoni->created_at));
                                $year = date('Y',strtotime($testimoni->created_at));
                            @endphp
                            <div class="col-md-4">
                                <figure class="snip1390">
                                @if ($testimoni->admin_id !== null)
                                    <img src="{{ (!empty($testimoni->admin->profile)) ? asset($testimoni->admin->profile) : asset('frontend/img/user.png') }}" alt="profile-sample3" class="profile" />
                                @elseif($testimoni->asistant_id !== null)
                                    <img src="{{ (!empty($testimoni->asistant->profile)) ? asset($testimoni->asistant->profile) : asset('frontend/img/user.png') }}" alt="profile-sample3" class="profile" />
                                @elseif($testimoni->dosen_id !== null)
                                    <img src="{{ (!empty($testimoni->dosen->profile)) ? asset($testimoni->dosen->profile) : asset('frontend/img/user.png') }}" alt="profile-sample3" class="profile" />
                                @elseif($testimoni->lead_id !== null)
                                    <img src="{{ (!empty($testimoni->lead->profile)) ? asset($testimoni->lead->profile) : asset('frontend/img/user.png') }}" alt="profile-sample3" class="profile" />
                                @elseif($testimoni->user_id !== null)
                                    <img src="{{ (!empty($testimoni->user->profile)) ? asset($testimoni->user->profile) : asset('frontend/img/user.png') }}" alt="profile-sample3" class="profile" />
                                @endif
                                <figcaption>
                                    @if ($testimoni->admin_id !== null)
                                        <h2>{{ Str::limit($testimoni->admin->name, 15) }}</h2>
                                    @elseif($testimoni->asistant_id !== null)
                                        <h2>{{ Str::limit($testimoni->asistant->name, 15) }}</h2>
                                    @elseif($testimoni->dosen_id !== null)
                                        <h2>{{ Str::limit($testimoni->dosen->name, 15) }}</h2>
                                    @elseif($testimoni->lead_id !== null)
                                        <h2>{{ Str::limit($testimoni->lead->name , 15)}}</h2>
                                    @elseif($testimoni->user_id !== null)
                                        <h2>{{ Str::limit($testimoni->user->name , 15)}}</h2>
                                    @endif
                                    <h4>{{ $date }} {{ Str::substr($month, 0, 3) }},  {{ $year }}</h4>
                                    <blockquote>{{ $testimoni->testimoni }}</blockquote>
                                </figcaption>
                                </figure>
                            </div>
                        @endforeach  
                        <div class="container mt-3">
                            <div class="d-flex justify-content-center">
                                {{ $testimonies->links() }}
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="section_title text-center">
                                <h4>Testimoni belum tersedia</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="contact-title">Berikan Testimoni Anda</h2>
                    <p>Pastikan anda telah login sebelum meberikan testimoni !</p>
                </div>
                <div class="col-lg-12">
                    @if(Auth::guard('admin')->check())
                        <form method="POST" class="form-contact contact_form" action="{{ route('admin.testimoni') }}" method="post">
                    @elseif(Auth::guard('asistant')->check())
                        <form method="POST" class="form-contact contact_form" action="{{ route('asistant.testimoni') }}" method="post">
                    @elseif(Auth::guard('dosen')->check())
                        <form method="POST" class="form-contact contact_form" action="{{ route('dosen.testimoni') }}" method="post">
                    @elseif(Auth::guard('lead')->check())
                        <form method="POST" class="form-contact contact_form" action="{{ route('lead.testimoni') }}" method="post">
                    @elseif(Auth::guard('web')->check())
                        <form method="POST" class="form-contact contact_form" action="{{ route('user.testimoni') }}" method="post">
                    @elseif (!Auth::user())
                        <form method="POST" class="form-contact contact_form" action="{{ route('user.testimoni') }}" method="post">  
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="testimoni" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tulis Testimonie'" placeholder="Testimoni" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection