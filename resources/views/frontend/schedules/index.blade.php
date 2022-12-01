@extends('frontend.layouts.main')
@section('main')
    <div class="bradcam_area breadcam_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Jadwal Laboratorium</h3>
                    </div>
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
                        <h3>Jadwal Harian</h3>
                    </div>
                    <form action="{{ route('home.schedules') }}" class="mt-3 mb-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Jadwal Dosen" aria-label="Cari Gallery">
                                <div class="input-group-append">
                                <button class="btn btn-sm btn-warning" type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('home.schedules') }}">
                        <div class="single_input" style="text-align: center; margin-bottom: 3%">
                            <input type="date" name="search" value="{{ request('search') }}" required>
                            <button type="submit" class="btn btn-sm btn-white">
                                <img src="{{ asset('frontend/img/search.png') }}">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($schedules != [])
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <p>Hasil Pencarian</p>
                    </div>
                </div>
                <div class="row">
                    @if ($schedules->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jadwal</th>
                                    <th scope="col">Dosen</th>
                                    <th scope="col">Mata Kuliah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($schedules as $schedule)
                                    @php
                                            $date = date('d',strtotime($schedule->hour));
                                            $month = date('F',strtotime($schedule->hour));
                                            $year = date('Y',strtotime($schedule->hour));
                                            $hour = date('H:i',strtotime($schedule->hour));
                                            $enddate = date('d',strtotime($schedule->endhour));
                                            $endmonth = date('F',strtotime($schedule->endhour));
                                            $endyear = date('Y',strtotime($schedule->endhour));
                                            $endhour = date('H:i',strtotime($schedule->hour));
                                            $day = date('D', strtotime($schedule->hour));
                                            $dayList = array(
                                                'Sun' => 'Minggu',
                                                'Mon' => 'Senin',
                                                'Tue' => 'Selasa',
                                                'Wed' => 'Rabu',
                                                'Thu' => 'Kamis',
                                                'Fri' => 'Jumat',
                                                'Sat' => 'Sabtu'
                                            );
                                    @endphp
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td>{{ $dayList[$day] }}</td>
                                        <td>{{ $hour }} - {{ $endhour }}</td>
                                        <td>{{ $schedule->teacher}}</td>
                                        <td>{{ $schedule->lesson}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-lg-12">
                            <div class="section_title text-center">
                                <p>Jadwal tidak temukan</p>
                            </div>
                        </div>
                    @endif
                </div>
            @else
            @endif
            @if ($todays->count())
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <p>Jadwal Hari ini</p>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Jadwal</th>
                                <th scope="col">Dosen</th>
                                <th scope="col">Mata Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($todays as $today)
                                @php
                                    $date = date('d',strtotime($today->hour));
                                    $month = date('F',strtotime($today->hour));
                                    $year = date('Y',strtotime($today->hour));
                                    $hour = date('H:i',strtotime($today->hour));
                                    $enddate = date('d',strtotime($today->endhour));
                                    $endmonth = date('F',strtotime($today->endhour));
                                    $endyear = date('Y',strtotime($today->endhour));
                                    $endhour = date('H:i',strtotime($today->hour));
                                    $day = date('D', strtotime($today->hour));
                                    $dayList = array(
                                        'Sun' => 'Minggu',
                                        'Mon' => 'Senin',
                                        'Tue' => 'Selasa',
                                        'Wed' => 'Rabu',
                                        'Thu' => 'Kamis',
                                        'Fri' => 'Jumat',
                                        'Sat' => 'Sabtu'
                                    );
                                @endphp
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>{{ $dayList[$day] }}</td>
                                    <td>{{ $hour }} - {{ $endhour }} WIB</td>
                                    <td>{{ $today->teacher}}</td>
                                    <td>{{ $today->lesson}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <p>Jadwal Hari ini Belum di input oleh admin</p>
                    </div>
                </div>
            @endif
            <div class="row" style="margin-top: 5%">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <h3>Jadwal Semester</h3>
                    </div>
                </div>
            </div>
            @if ($periods->count())
                <div class="row">
                    <table class="table">
                        <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jadwal</th>
                                    <th scope="col">Lihat</th>
                                </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($periods as $period)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>{{ $period->name }}</td>
                                    <td>
                                        <a target="_blank" href="{{ asset($period->file) }}" class="genric-btn default-border circle arrow">
                                            <img src="{{ asset('frontend/img/eye.png') }}" alt="">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <p>Jadwal Semester Belum tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection