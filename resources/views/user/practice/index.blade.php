@extends('user.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Praktikum Anda</h4>
          <p class="card-description">
              Daftar praktikum 
          </p>
          <form action="{{ route('mahasiswa.praktikum') }}">
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Praktikum" aria-label="Cari Praktikum">
                <div class="input-group-append">
                  <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
              </div>
            </div>
          </form>
          <div class="btn-group">
            <form action="{{ route('mahasiswa.praktikum') }}">
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
          @if ($practices->count())
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>
                      Mata Kuliah 
                    </th>
                    <th>
                      Dosen 
                    </th>
                    <th>
                      Jadwal
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($practices as $practice)
                        <tr>
                            <td class="py-1">
                                {{ $practice->lesson }}
                            </td>
                            <td>
                                {{ $practice->dosen }}
                            </td>
                            <td>
                                {{ $practice->time }}, {{ $practice->day }}
                            </td>
                            <td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="d-flex justify-content-center">
              <p class="text-muted">Praktikum tidak di temukan</p>
            </div>
          @endif
          <div class="d-flex justify-content-center mt-3">
            {{ $practices->links() }}
          </div>
        </div>
      </div>
  </div>
@endsection