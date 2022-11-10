@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kategori Berita</h4>
                <p class="card-description">
                    Daftar kategori berita <code><a href="{{ route('admin.news-category.add') }}">Tambah</a></code>
                </p>
                <form action="{{ route('admin.news-category') }}">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Kategori Berita" aria-label="Cari Kategori Berita">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                        </div>
                      </div>
                    </div>
                </form>
                @if ($categories->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                Kategori
                                </th>
                                <th>
                                Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="py-1">
                                            {{$category->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.news-category.edit', $category->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.news-category.delete', $category->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                        <p class="text-muted">Kategori berita tidak di temukan</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection