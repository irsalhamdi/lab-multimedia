@extends('user.layouts.main')
@section('main')
    <div class="content-wrapper">
        <div class="row">
            @foreach ($trainings as $training)
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <img class="mb-3" src="{{ asset($training->training->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 280px; height: 280px;"> 
                            <div class="d-flex flex-wrap justify-content-between">
                                <h4 href="{{ route('mahasiswa.pelatihan.detail', $training->training->id) }}" style="color: #df105b">
                                    {{ Str::limit($training->training->name, 50) }}
                                </h4>
                                <a href="{{ route('mahasiswa.pelatihan.detail', $training->training->id) }}" type="button" class="btn btn-sm btn-light">Detail</a>
                            </div>
                            @php
                                $date = date('d',strtotime($training->training->date));
                                $month = date('F',strtotime($training->training->date));
                                $year = date('Y',strtotime($training->training->date));
                                $hour = date('H:i',strtotime($training->training->date));
                            @endphp
                            <p class="card-description">
                                <i class="typcn typcn-location-outline"></i> 
                                <span class="text-warning mb-1 font-weight-bold"><code>{{ $training->training->place }}</code></span>
                                <i class="typcn typcn-time"></i> 
                                <span class="text-warning mb-1 font-weight-bold"><code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code></span>
                            </p>
                            {!! Str::limit($training->training->description, 68) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection