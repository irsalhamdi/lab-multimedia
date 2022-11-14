@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Jadwal </h4>
            <p class="card-description">
                Daftar Jadwal <code><a href="{{ route('admin.schedule.add') }}">Tambah</a></code>
            </p>
            <form action="{{ route('admin.schedules') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Jadwal" aria-label="Cari Jadwal">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($schedules->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Jadwal
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="py-1">
                                        {{$schedule->name }}
                                    </td>
                                    <td class="py-1">
                                        <img src="{{ ($schedule->image != null) ? asset($schedule->image) : asset('frontend/img/schedule.png') }}" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.schedule.edit', $schedule->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.schedule.delete', $schedule->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                    <p class="text-muted">Jadwal tidak di temukan</p>
                </div>
            @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $schedules->links() }}
                </div>
        </div>
        </div>
    </div>
@endsection