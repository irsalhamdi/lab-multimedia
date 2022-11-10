@extends('user.layouts.main')
@section('main')
    <div class="row">
        @foreach ($participants as $participant)
            @php
                $date = date('d',strtotime($participant->dedication->date));
                $month = date('F',strtotime($participant->dedication->date));
                $year = date('Y',strtotime($participant->dedication->date));
                $hour = date('H:i',strtotime($participant->dedication->date));
            @endphp
            <div class="col-xl-6 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">{{ Str::limit($participant->dedication->name, 40) }}</h4>
                            <a href="{{ route('mahasiswa.community.dedication.join', $participant->dedication->id) }}" type="button" class="btn btn-sm btn-light">Detail</a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-md-flex mb-4">
                                    <div class="mr-md-5 mb-4">
                                        <i class="typcn typcn-location-outline"></i>
                                        <span class="text-warning mb-1 font-weight-bold">{{ $participant->dedication->place }}</span>
                                    </div>
                                    <div class="mr-md-5 mb-4">
                                        <i class="typcn typcn-time"></i>
                                        <span class="text-warning mb-1 font-weight-bold">{{ $date }} {{ $month }} {{ $year }}</span>
                                    </div>
                                    <div class="mr-md-5 mb-4">
                                        <i class="typcn typcn-tags mr-1"></i>
                                        <span class="text-warning mb-1 font-weight-bold">{{ $participant->dedication->dosen->name }}</span>
                                    </div>
                                </div>
                                <div class="font-weight-medium">
                                    <img class="mb-3" src="{{ asset($participant->dedication->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 280px; height: 280px;"> 
                                    {{ Str::limit($participant->dedication->excerpt, 70) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection