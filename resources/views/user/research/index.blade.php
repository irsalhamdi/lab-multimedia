@extends('user.layouts.main')
@section('main')
    <div class="container">
        @if (session()->has('complete'))
        <div class="alert alert-success" role="alert">
            {{ session('complete') }}
        </div>
        @endif
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Penelitian Anda</h4>
                <p class="card-description">
                    Daftar Penelitian Anda
                </p>
                <form action="{{ route('mahasiswa.penelitian.individu') }}">
                    <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Galeri" aria-label="Cari Galeri">
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
                                    Kategori
                                </th>
                                <th>
                                    Judul
                                </th>
                                <th>
                                    Hasil
                                </th>
                                <th>
                                    Informasi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($researchs as $research)
                                    <tr>
                                        <td class="py-1">
                                            {{$research->category }}
                                        </td>
                                        <td class="py-1">
                                            {{ $research->title }}
                                        </td>
                                        <td>
                                            @if ($research->status === 0)
                                            @else
                                                <a href="{{ route('mahasiswa.penelitian.individu.hasil', $research->id) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap">
                                                    <i class="typcn typcn-upload"></i>
                                                </a>                                        
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mahasiswa.penelitian.individu.information', $research->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
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