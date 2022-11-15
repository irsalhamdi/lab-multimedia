@extends('dosen.layouts.main')
@section('main')
<div class="container">
  @if (session()->has('complete'))
      <div class="alert alert-success" role="alert">
          {{ session('complete') }}
      </div>
  @endif
</div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Peserta</h4>
        <span style="float: right">
          <a href="{{ route('dosen.penelitian.participants.export', $research->id) }}" type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-arrow-forward-outline mr-2"></i>Export</a>
        </span>
        <p class="card-description">
            Daftar peserta Pengabdian Masyarakat {{ $research->name }}<code><a href="{{ route('dosen.penelitian.participants.add', $research->id) }}">Tambah</a></code>
        </p>
        <p class="card-description">
            <span>
              Peserta Maksimal : {{ $research->participants }}
            </span>
            @if ($quota === $research->participants)
              <span style="float: right; color: red">
                Tersedia : 0
              </span>
            @else
              <span style="float: right; color: green">
                Tersedia : {{ $research->participants - $quota  }}
              </span>
            @endif
        </p>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  Jurusan 
                </th>
                <th>
                  No Handphone 
                </th>
                <th>
                  Aksi 
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td class="py-1">
                          @if($participant->dosen_id === null)
                            {{ $participant->user->name }}
                          @elseif($participant->user_id === null)
                            {{ $participant->dosen->name }}
                          @endif
                        </td>
                        <td>
                          @if ($participant->dosen_id === null)
                            {{  $participant->user->jurusan  }}
                          @elseif($participant->user_id === null)
                            {{ $participant->dosen->jurusan }}
                          @endif
                        </td>
                        <td>
                          @if ($participant->dosen_id === null)
                            {{ $participant->user->phone }}
                          @elseif($participant->user_id === null)
                            {{ $participant->dosen->phone }}
                          @endif
                        </td>
                        <td>
                          @if ($participant->dosen_id === null)
                            @php
                                $user = App\Models\User::where('id', $participant->user_id)->first();
                            @endphp
                            <a href="{{ route('dosen.penelitian.participants.user.detail', $user->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-eye"></i>
                            </a>
                            <a href="{{ route('dosen.penelitian.participants.delete', $participant->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-delete-outline"></i>
                            </a>
                          @elseif($participant->user_id === null)
                            @php
                                $dosen = App\Models\User::where('id', $participant->dosen_id)->first();
                            @endphp 
                            <a href="{{ route('dosen.penelitian.participants.dosen.detail', $dosen->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-eye"></i>
                            </a>
                            <a href="{{ route('dosen.penelitian.participants.delete', $participant->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-delete-outline"></i>
                            </a>
                          @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection