@extends('lead.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pelatihan</h4>
        <p class="card-description">
            Daftar pelatihan <code><a href="{{ route('lead.training.add') }}">Tambah</a></code>
        </p>
        <form action="{{ route('lead.training') }}">
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Pelatihan" aria-label="Cari Pelatihan">
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
            </div>
          </div>
        </form>
        @if ($trainings->count())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    Judul
                  </th>
                  <th>
                    Status 
                  </th>
                  <th>
                    Peserta 
                  </th>
                  <th>
                    Materi 
                  </th>
                  <th>
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($trainings as $training)
                      @php
                        $date = date('d',strtotime($training->date));
                        $month = date('F',strtotime($training->date));
                        $year = date('Y',strtotime($training->date));
                        $hour = date('H:i',strtotime($training->date));
                      @endphp
                      <tr>
                          <td class="py-1">
                              {{  $training->name }}
                          </td>
                          <td>
                            @if ($training->status === 1)
                              <form action="{{ route('lead.training.status.unactive') }} ">
                                @csrf
                                <input type="hidden" name="id" value="{{ $training->id }}">
                                <button type="submit" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                  <i class="typcn typcn-cancel-outline"></i>
                                </button>
                              </form>
                            @else
                              <form action="{{ route('lead.training.status.active') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $training->id }}">
                                <button type="submit" class="btn btn-light btn-circle btn-sm justify-content-between flex-nowrap">
                                  <i class="typcn typcn-adjust-contrast"></i>
                                </button>
                              </form>
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('lead.training.participants', $training->id) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-user"></i>
                            </a>
                          </td>
                          <td>
                            <a href="{{ route('lead.training.learning.material', $training->id) }}" type="button" class="btn btn-info btn-circle btn-sm justify-content-between flex-nowrap">
                              <i class="typcn typcn-upload"></i>
                            </a>
                          </td>
                          <td>
                              <a href="{{ route('lead.training.show', $training->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-eye"></i>
                              </a>
                              <a href="{{ route('lead.training.edit', $training->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-edit"></i>
                              </a>
                              <a href="{{ route('lead.training.delete', $training->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
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
            <p class="text-muted">Pelatihan tidak di temukan</p>
          </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
          {{ $trainings->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection