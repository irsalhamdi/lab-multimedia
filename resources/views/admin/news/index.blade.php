@extends('admin.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Berita</h4>
        <p class="card-description">
            Daftar berita <code><a href="{{ route('admin.news.add') }}">Tambah</a></code>
        </p>
        <form action="{{ route('admin.news') }}">
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
                    Image
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
                            @if($new->admin_id !== null)
                              {{ $new->admin->name }}
                            @elseif($new->asistant_id !== null)
                              {{ $new->asistant->name }}
                            @elseif($new->dosen_id !== null)
                              {{ $new->dosen->name }}
                            @elseif($new->lead_id !== null)
                              {{ $new->lead->name }}
                            @elseif($new->user_id !== null)
                              {{ $new->user->name }}
                          @endif
                          </td>
                          <td>
                              {{ $new->title }}
                          </td>
                          <td>
                              <img src="{{ (!empty($new->image)) ? asset($new->image) : url('upload/default.jpg') }}" style="width: 60">
                          </td>
                          <td>
                          <td>
                              <a href="{{ route('admin.news.show', $new->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                <i class="typcn typcn-eye"></i>
                              </a>
                              <a href="{{ route('admin.news.edit', $new->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                  <i class="typcn typcn-edit"></i>
                              </a>
                              <a href="{{ route('admin.news.delete', $new->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
@endsection