@extends('admin.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Permintaan Berita</h4>
        <p class="card-description">
            Daftar Permintaan berita
        </p>
        <form action="{{ route('admin.news.request') }}">
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
                    Penulis 
                  </th>
                  <th>
                    Judul 
                  </th>
                  <th>
                    Lihat
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
                              {{ $new->user->name }}
                          </td>
                          <td>
                              {{ $new->title }}
                          </td>
                          <td>
                              <a href="{{ route('admin.news.show', $new->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                <i class="typcn typcn-eye"></i>
                              </a>
                          </td>
                          <td>
                          <td>
                            @if ($new->status === 0)
                                <form method="POST" action="{{ route('admin.news.request.acc') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $new->id }}">
                                    <button type="submit" class="btn btn-light btn-circle btn-sm justify-content-between flex-nowrap">
                                        <i class="typcn typcn-adjust-contrast"></i>
                                    </button>
                                </form>
                            @else
                            @endif
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
@endsection