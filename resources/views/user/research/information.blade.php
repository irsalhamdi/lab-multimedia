@extends('user.layouts.main')
@section('main')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 style="color: #df105b">
                                {{ $research->title }}
                            </h4>
                        </div>
                        @php
                            $date = date('d',strtotime($research->created_at));
                            $month = date('F',strtotime($research->created_at));
                            $year = date('Y',strtotime($research->created_at));
                            $hour = date('H:i',strtotime($research->created_at));
                        @endphp
                        <p class="card-description">
                            <i class="typcn typcn-time"></i> 
                            <span class="text-warning mb-1 font-weight-bold"><code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code></span>
                        </p>
                        <p>
                            {{$research->description }}
                        </p>
                        @if ($research->status === 0)
                            <p>
                                Status : <span class="text-danger">Diterima oleh admin</span> 
                            </p>
                            <p>
                                Informasi : <span class="text-danger">akan diinformasikan selanjutnya</span> 
                            </p>
                        @else
                            <p>
                                Status : <span class="text-success">Berhasil</span> 
                            </p>
                            <p>
                                Informasi : <span class="text-success">{{ $research->information }}</span> 
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  