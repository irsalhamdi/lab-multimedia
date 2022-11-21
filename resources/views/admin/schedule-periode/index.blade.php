@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jadwal Semester Laboratorium</h4>
                <p class="card-description">
                    Daftar Jadwal Semester<code><a href="{{ route('admin.schedule.period.add') }}">Tambah</a></code>
                </p>
                <form action="{{ route('admin.schedule.period') }}">
                    <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Jadwal Semester" aria-label="Cari Jadwal Semester">
                        <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                    </div>
                </form>
                <div class="btn-group">
                    <form action="{{ route('admin.schedule.period') }}">
                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                          Tahun
                        </a>
                        <div class="dropdown-menu">
                            @if ($years->count())
                                @foreach ($years as $year)
                                    <button id="year" onclick="submit()" type="submit" name="search" value="{{ $year->year }}" class="dropdown-item" href="#">{{ $year->year }}</button>
                                @endforeach
                            @else
                            @endif
                        </div>
                    </form>
                </div>
                @if ($schedules->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Jadwal
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
                                        <td>
                                            <a href="{{ route('admin.schedule.period.edit', $schedule->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.schedule.period.delete', $schedule->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                        <p class="text-muted">Jadwal Semester tidak di temukan</p>
                    </div>
                @endif
                    <div class="d-flex justify-content-center mt-3">
                        {{ $schedules->links() }}
                    </div>
            </div>
        </div>
    </div>
    <script>
        function submit(){
            document.getElementById('year').submit();
        }
    </script>
@endsection