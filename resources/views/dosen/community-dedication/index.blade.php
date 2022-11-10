@extends('dosen.layouts.main')
@section('main')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pengabdian Masyarakat</h4>
        <p class="card-description">
            Daftar Pengabdian Masyarakat <code><a href="{{ route('dosen.community.dedication.add') }}">Tambah</a></code>
        </p>
        <form action="">
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Pengabdian" aria-label="Cari Pengabdian">
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
            </div>
          </div>
        </form>
        @if ($dedications->count())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    Nama
                  </th>
                  <th>
                    Jadwal 
                  </th>
                  <th>
                      Tempat 
                  </th>
                  <th>
                      Peserta 
                  </th>
                  <th>
                    Panduan
                  </th>
                  <th>
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($dedications as $dedication)
                      @php
                        $date = date('d',strtotime($dedication->date));
                        $month = date('F',strtotime($dedication->date));
                        $year = date('Y',strtotime($dedication->date));
                        $hour = date('H:i',strtotime($dedication->date));
                      @endphp
                      <tr>
                          <td class="py-1">
                              {{  $dedication->name }}
                          </td>
                          <td>
                            {{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}, {{ $hour }}
                          </td>
                          <td>
                            {{ $dedication->place }}
                          </td>
                          <td>
                            <a href="{{ route('dosen.community.dedication.participants', $dedication->id) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap">
                                <i class="typcn typcn-user"></i>
                              </a>
                          </td>
                          <td>
                            <a href="{{ route('dosen.community.dedication.guide', $dedication->id) }}" type="button" class="btn btn-info btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-upload"></i>
                            </a>
                          </td>
                          <td>
                              <a href="{{ route('dosen.community.dedication.show', $dedication->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-eye"></i>
                              </a>
                              <a href="{{ route('dosen.community.dedication.edit', $dedication->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-edit"></i>
                              </a>
                              <a href="{{ route('dosen.community.dedication.delete', $dedication->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-delete-outline"></i>
                              </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="d-flex justify-content-center">
            <p class="text-muted">Pengabdian tidak di temukan</p>
          </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
          {{-- {{ $trainings->links() }} --}}
        </div>
      </div>
    </div>
</div>
@endsection