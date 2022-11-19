@extends('user.layouts.main')
@section('main')
  @if (Auth::user()->status === 0)
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-description">
          Menu ini hanya tesedia untuk member lab. Silahkan daftarkan diri anda terlebih dahulu.
          <code>
            <a href="{{ route('mahasiswa.daftar.member') }}">
            Daftar
            </a>
          </code>
        </p>
      </div>
    </div>
  </div>
  @else
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Berita</h4>
          <p class="card-description">
              Daftar berita <code><a href="{{ route('mahasiswa.berita.add') }}">Tambah</a></code>
          </p>
          <form action="{{ route('mahasiswa.berita') }}">
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Berita" aria-label="Cari Berita">
                <div class="input-group-append">
                  <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
              </div>
            </div>
          </form>
          @if ($news->count())
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>
                      Kategori 
                    </th>
                    <th>
                      Judul 
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Aksi
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($news as $new)
                        <tr>
                            <td class="py-1">
                                {{ $new->category->name }}
                            </td>
                            <td>
                                {{ $new->title }}
                            </td>
                            <td>
                              @if ($new->status === 0)
                                  Belum di Acc
                              @else
                                  Acc
                              @endif
                            </td>
                            <td>
                            <td>
                                <a href="{{ route('mahasiswa.berita.show', $new->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                  <i class="typcn typcn-eye"></i>
                                </a>
                                <a href="{{ route('mahasiswa.berita.edit', $new->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                    <i class="typcn typcn-edit"></i>
                                </a>
                                <a href="{{ route('mahasiswa.berita.delete', $new->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
              <p class="text-muted">Berita tidak di temukan</p>
            </div>
          @endif
          <div class="d-flex justify-content-center mt-3">
            {{ $news->links() }}
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection