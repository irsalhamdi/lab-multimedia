@extends('asistant.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dosen </h4>
                <p class="card-description">
                    Daftar Dosen <code><a href="{{ route('asistant.dosen.add') }}">Tambah</a></code>
                </p>
                <form action="{{ route('asistant.dosen') }}">
                    <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Dosen" aria-label="Cari Dosen">
                        <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                    </div>
                </form>
                <div class="btn-group">
                    <form action="{{ route('asistant.dosen') }}">
                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Jurusan
                        </a>
                        <div class="dropdown-menu">
                            <button id="year" onclick="submit()" type="submit" name="search" value="Komputerisasi Akuntansi" class="dropdown-item" href="#">Komputerisasi Akuntansi</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Manajemen Informatika" class="dropdown-item" href="#">Manajemen Informatika</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Sistem Informasi" class="dropdown-item" href="#">Sistem Informasi</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Sistem Komputer" class="dropdown-item" href="#">Sistem Komputer</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Teknik Komputer" class="dropdown-item" href="#">Teknik Komputer</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Teknik Informatika" class="dropdown-item" href="#">Teknik Informatika</button>
                            <button id="year" onclick="submit()" type="submit" name="search" value="Teknik Komputer Jaringan" class="dropdown-item" href="#">Teknik Komputer Jaringan</button>
                        </div>
                    </form>
                </div>
                @if ($dosens->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    NIP
                                </th>
                                <th>
                                    Jurusan
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosens as $dosen)
                                    <tr>
                                        <td class="py-1">
                                            {{$dosen->name }}
                                        </td>
                                        <td class="py-1">
                                            {{$dosen->nip }}
                                        </td>
                                        <td class="py-1">
                                            {{$dosen->jurusan }}
                                        </td>
                                        <td>
                                            <a href="{{ route('asistant.dosen.edit', $dosen->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="{{ route('asistant.dosen.delete', $dosen->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                        <p class="text-muted">Dosen tidak di temukan</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $dosens->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection