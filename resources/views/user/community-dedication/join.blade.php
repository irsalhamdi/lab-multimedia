@extends('user.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($dedication->date));
        $month = date('F',strtotime($dedication->date));
        $year = date('Y',strtotime($dedication->date));
        $hour = date('H:i',strtotime($dedication->date));
    @endphp
        <div class="container">
          @if (session()->has('complete'))
              <div class="alert alert-success" role="alert">
                  {{ session('complete') }}
              </div>
          @endif
      </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-3">{{ $dedication->name }}</h4>
                <div class="d-md-flex mb-4">
                    <div class="mr-md-5 mb-4">
                      <i class="typcn typcn-location-outline"></i>
                        <span class="text-warning mb-1 font-weight-bold">{{ $dedication->place }}</span>
                    </div>
                    <div class="mr-md-5 mb-4">
                      <i class="typcn typcn-time"></i>
                        <span class="text-warning mb-1 font-weight-bold">{{ $date }} {{ $month }} {{ $year }}</span>
                    </div>
                    <div class="mr-md-5 mb-4">
                      <i class="typcn typcn-tags mr-1"></i>
                        <span class="text-warning mb-1 font-weight-bold">{{ $dedication->dosen->name }}</span>
                    </div>
                </div>
                <img class="mb-3" src="{{ asset($dedication->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 280px; height: 280px;"> 
                <p>
                  {!! $dedication->description !!}
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
                        <iframe type="application/pdf" src="{{ asset('upload/dedication/guide/'.$guide->file) }}" height="600" style="width: 100%;"></iframe>
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
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Anggota Pengabdian</h4>
                <p class="card-description">
                  Form Tambah Anggota
                </p>
                <p class="card-description">
                  <span>
                    Peserta Maksimal : {{ $dedication->participants }}
                  </span>
                  @if ($quota === $dedication->participants)
                    <span style="float: right; color: red">
                      Tersedia : 0
                    </span>
                  @else
                    <span style="float: right; color: green">
                      Tersedia : {{ $dedication->participants - $quota  }}
                    </span>
                  @endif
              </p>
                <form method="POST" action="{{ route('mahasiswa.community.dedication.participants.store', $dedication->id) }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="user_id" class="form-control" required>
                            <option selected="" disabled="">
                                Pilih mahasiswa
                            </option>
                            @foreach ($users as $user)
                                @if (old('user_id') == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <a href="{{ route('mahasiswa.community.dedication.joins') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
      </div>
    </div>
@endsection