@extends('asistant.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Peralatan Laboratorium</h4>
        <span style="float: right">
          <a href="{{ route('asistant.tool.export') }}" type="button" class="btn btn-sm bg-white btn-icon-text border mb-3"><i class="typcn typcn-arrow-forward-outline mr-2"></i>Export</a>
        </span>
        <p class="card-description">
            Daftar peralatan <code><a href="{{ route('asistant.tool.create') }}">Tambah</a></code>
        </p>
        <form action="{{ route('asistant.tools') }}">
          <div class="form-group">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Peralatan" aria-label="Cari Peralatan">
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
            </div>
          </div>
        </form>
        @if ($tools->count())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    Nama
                  </th>
                  <th>
                    Jumlah 
                  </th>
                  <th>
                    Kategori
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
                  @foreach ($tools as $tool)
                      <tr>
                          <td class="py-1">
                              {{  $tool->name }}
                          </td>
                          <td>
                            {{  $tool->quantity }}
                          </td>
                          <td>
                            @if ($tool->category === 0)
                              Praktikum
                            @else
                              Penelitian
                            @endif
                          </td>
                          <td>
                            <img src="{{ (!empty($tool->image)) ? asset($tool->image) : url('upload/default.jpg') }}" style="width: 60">
                          </td>
                          <td>
                              <a href="{{ route('asistant.tool.edit', $tool->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                  <i class="typcn typcn-edit"></i>
                              </a>
                              <a href="{{ route('asistant.tool.delete', $tool->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
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
            <p class="text-muted">Peralatan tidak di temukan</p>
          </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
          {{ $tools->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection