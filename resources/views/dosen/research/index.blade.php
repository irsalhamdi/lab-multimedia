@extends('dosen.layouts.main')
@section('main')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Penelitian</h4>
        <p class="card-description">
            Daftar Penelitian <code><a href="{{ route('dosen.penelitian.add') }}">Tambah</a></code>
        </p>
        <form action="{{ route('dosen.penelitian') }}">
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Penelitian" aria-label="Cari Penelitian">
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
            </div>
          </div>
        </form>
        @if ($researchs->count())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    Nama
                  </th>
                  <th>
                    Hasil 
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
                  @foreach ($researchs as $research)
                      @php
                        $date = date('d',strtotime($research->date));
                        $month = date('F',strtotime($research->date));
                        $year = date('Y',strtotime($research->date));
                        $hour = date('H:i',strtotime($research->date));
                      @endphp
                      <tr>
                          <td class="py-1">
                              {{  $research->title }}
                          </td>
                          <td>
                            <a href="{{ route('dosen.penelitian.hasil', $research->id) }}" type="button" class="btn btn-link btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-document"></i>
                            </a>
                          </td>
                          <td>
                            <a href="{{ route('dosen.penelitian.participants', $research->id) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap">
                                <i class="typcn typcn-user"></i>
                            </a>
                          </td>
                          <td>
                            <a href="{{ route('dosen.penelitian.guide', $research->id) }}" type="button" class="btn btn-info btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-upload"></i>
                            </a>
                          </td>
                          <td>
                              <a href="{{ route('dosen.penelitian.show', $research->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-eye"></i>
                              </a>
                              <a href="{{ route('dosen.penelitian.edit', $research->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-edit"></i>
                              </a>
                              <a href="{{ route('dosen.penelitian.delete', $research->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
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
            <p class="text-muted">Penelitian tidak di temukan</p>
          </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
          {{ $researchs->links() }}
        </div>
      </div>
    </div>
</div>
@endsection