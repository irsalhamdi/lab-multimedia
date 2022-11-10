@extends('asistant.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Rilis</h4>
            <p class="card-description">
                Daftar rilis <code><a href="{{ route('asistant.release.add') }}">Tambah</a></code>
            </p>
            <form action="{{ route('asistant.release') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Rilis" aria-label="Cari Rilis">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($releases->count())
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
                                Image
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($releases as $release)
                                <tr>
                                    <td class="py-1">
                                        {{$release->category->name }}
                                    </td>
                                    <td>
                                        {{ $release->name }}
                                    </td>
                                    <td>
                                        <img src="{{ (!empty($release->file)) ? asset($release->file) : url('upload/default.jpg') }}" style="width: 60">
                                    </td>
                                    <td>
                                        <a href="{{ route('asistant.release.show', $release->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-eye"></i>
                                        </a>
                                        <a href="{{ route('asistant.release.edit', $release->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-edit"></i>
                                        </a>
                                        <a href="{{ route('asistant.release.delete', $release->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                    <p class="text-muted">Rilis tidak di temukan</p>
                </div>
            @endif
            <div class="d-flex justify-content-center mt-3">
                {{ $releases->links() }}
            </div>
        </div>
        </div>
    </div>
@endsection