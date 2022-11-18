@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Galeri </h4>
            <p class="card-description">
                Daftar Galeri <code><a href="{{ route('admin.gallery.add') }}">Tambah</a></code>
            </p>
            <form action="{{ route('admin.galleries') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Galeri" aria-label="Cari Galeri">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($galleries->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Galeri
                            </th>
                            <th>
                                Gambar
                            </th>
                            <th>
                                Galeri
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $gallery)
                                <tr>
                                    <td class="py-1">
                                        {{$gallery->title }}
                                    </td>
                                    <td class="py-1">
                                        <img src="{{ ($gallery->image != null) ? asset($gallery->image) : asset('frontend/img/gallery.png') }}" alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.gallery.edit.image', $gallery->id) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-upload"></i>
                                        </a>                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.gallery.delete', $gallery->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                    <p class="text-muted">Galeri tidak di temukan</p>
                </div>
            @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $galleries->links() }}
                </div>
        </div>
        </div>
    </div>
@endsection