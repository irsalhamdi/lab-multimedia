@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Penelitian Mahasiswa</h4>
            <form action="{{ route('admin.research') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Penelitian" aria-label="Cari Penelitian">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($researchs->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
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
                            @foreach ($researchs as $research)
                                <tr>
                                    <td class="py-1">
                                        {{$research->title }}
                                    </td>
                                    <td>
                                        @if ($research->status === 0)
                                            Belum Acc
                                        @else
                                            Acc
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.research.detail', $research->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                            <i class="typcn typcn-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <p class="text-muted">Penelitian tidak di temukan</p>
                </div>
            @endif
            <div class="d-flex justify-content-center mt-3">
                {{ $researchs->links() }}
            </div>
        </div>
        </div>
    </div>
@endsection