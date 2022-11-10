@extends('asistant.layouts.main')
@section('main')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Kategori Pelatihan</h4>
        <p class="card-description">
            Daftar kategori pelatihan <code><a href="{{ route('asistant.training-category.add') }}">Tambah</a></code>
        </p>
        <form action="{{ route('asistant.training-category') }}">
            <div class="form-group">
              <div class="input-group">
                  <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Kategori Pelatihan" aria-label="Cari Kategori Pelatihan">
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
                        Kategori
                        </th>
                        <th>
                        Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainings as $training)
                            <tr>
                                <td class="py-1">
                                    {{$training->name }}
                                </td>
                                <td>
                                    <a href="{{ route('asistant.training-category.edit', $training->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                        <i class="typcn typcn-edit"></i>
                                    </a>
                                    <a href="{{ route('asistant.training-category.delete', $training->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                <p class="text-muted">Kategori pelatihan tidak di temukan</p>
            </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
            {{ $trainings->links() }}
        </div>
    </div>
    </div>
</div>
@endsection