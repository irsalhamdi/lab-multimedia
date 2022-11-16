@extends('dosen.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($research->date));
        $month = date('F',strtotime($research->date));
        $year = date('Y',strtotime($research->date));
        $hour = date('H:i',strtotime($research->date));
    @endphp
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">{{ $research->title }}</h4>
                <div class="d-md-flex mb-4">
                    <div class="mr-md-5 mb-4">
                      <i class="typcn typcn-time"></i> 
                        <span class="text-warning mb-1 font-weight-bold">{{ $date }} {{ $month }} {{ $year }}</span>
                    </div>
                    <div class="mr-md-5 mb-4">
                      <i class="typcn typcn-tags mr-1"></i>
                        <span class="text-warning mb-1 font-weight-bold">{{ $research->dosen->name }}</span>
                    </div>
                </div>
                <img class="mb-3" src="{{ asset($research->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 300px; height: 300px;"> 
                <p>
                  {!! $research->description !!}
                </p>
              </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Panduan</h4>
                @if ($guide)
                  <div class="container">
                    <p align="center">
                        <iframe type="application/pdf" src="{{ asset('upload/research-teacher/guide/'.$guide->file) }}" height="600" style="width: 100%;"></iframe>
                    </p>
                  </div>
                @else
                  <div class="container">
                    <p align="center">
                      Panduan Belum tersedia
                    </p>
                  </div>
                @endif
              </div>
            </div>
        </div>         
    </div>
@endsection