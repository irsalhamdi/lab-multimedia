@extends('lead.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Mahasiswa </h4>
                <p class="card-description">
                    Daftar Mahasiswa <code><a href="{{ route('lead.mahasiswa.add') }}">Tambah</a></code>
                </p>
                <form action="{{ route('lead.mahasiswa') }}">
                    <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Mahasiswa" aria-label="Cari Mahasiswa">
                        <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                    </div>
                </form>
                <div class="btn-group">
                    <form action="{{ route('lead.mahasiswa') }}">
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
                @if ($users->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    NIM
                                </th>
                                <th>
                                    Jurusan
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="py-1">
                                            {{$user->name }}
                                        </td>
                                        <td class="py-1">
                                            {{$user->nim }}
                                        </td>
                                        <td class="py-1">
                                            {{$user->jurusan }}
                                        </td>
                                        <td class="py-1">
                                            @if ($user->status === 1)
                                                Member Lab
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('lead.mahasiswa.edit', $user->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-edit"></i>
                                            </a>
                                            <a href="{{ route('lead.mahasiswa.delete', $user->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                        <p class="text-muted">Mahasiswa tidak di temukan</p>
                    </div>
                @endif
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->links() }}
                    </div>
            </div>
        </div>
    </div>
@endsection