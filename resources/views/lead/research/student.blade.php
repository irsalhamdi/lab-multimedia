@extends('lead.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Penelitian Mahasiswa</h4>
                <form action="{{ route('lead.research.student') }}">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Penelitian" aria-label="Cari Penelitian">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="btn-group">
                    <form action="{{ route('lead.research.student') }}">
                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                          Tahun
                        </a>
                        <div class="dropdown-menu">
                            @if ($years->count())
                                @foreach ($years as $year)
                                    <button id="year" onclick="submit()" type="submit" name="search" value="{{ $year->year }}" class="dropdown-item" href="#">{{ $year->year }}</button>
                                @endforeach
                            @else
                            @endif
                        </div>
                    </form>
                </div>
                <div class="btn-group">
                    <form action="{{ route('lead.research.student') }}">
                        <a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                          Kategori
                        </a>
                        <div class="dropdown-menu">
                            <button id="category" onclick="category()" type="submit" name="search" value="Penelitian Tugas Akhir" class="dropdown-item" href="#">Tugas Akhir</button>
                            <button id="category" onclick="category()" type="submit" name="search" value="Penelitian Magang" class="dropdown-item" href="#">Magang</button>
                            <button id="category" onclick="category()" type="submit" name="search" value="Penelitian Lain" class="dropdown-item" href="#">Lain</button>
                        </div>
                    </form>
                </div>
                @if ($researchs->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Judul
                                </th>
                                <th>
                                    Tanggal 
                                </th>
                                <th>
                                    Informasi
                                </th>
                                <th>
                                    Hasil
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($researchs as $research)
                                    <tr>
                                        <td class="py-1">
                                            {{$research->user->name }}
                                        </td>
                                        <td>
                                            {{ $research->category }}
                                        </td>
                                        <td>
                                            {{$research->title }}
                                        </td>
                                        <td>
                                            @php
                                                $date = date('d',strtotime($research->created_at));
                                                $month = date('F',strtotime($research->created_at));
                                                $year = date('Y',strtotime($research->created_at));
                                                $hour = date('H:i',strtotime($research->created_at));
                                            @endphp
                                            {{ $date }} {{ $month }} {{ $year }}
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal{{ $research->id }}" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                                <i class="typcn typcn-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            @php
                                                $result = App\Models\ResearchResult::where('research_id', $research->id)->first();
                                            @endphp
                                            @if ($result)
                                                <a target="_blank" href="{{ asset('upload/research/result/'.$result->file) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                                    <i class="typcn typcn-upload"></i>
                                                </a>
                                            @else
                                                Belum Tersedia
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{ $research->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $research->title }}</h5>
                                                    @php
                                                        $date = date('d',strtotime($research->created_at));
                                                        $month = date('F',strtotime($research->created_at));
                                                        $year = date('Y',strtotime($research->created_at));
                                                        $hour = date('H:i',strtotime($research->created_at));
                                                    @endphp
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <i class="typcn typcn-time"></i> {{ $date }} {{ $month }} {{ $year }}
                                                    <i class="typcn typcn-user"></i> {{ $research->dosen }} <br><br>
                                                    {{ $research->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        function submit(){
            document.getElementById('year').submit();
        }
        function category(){
            document.getElementById('category').submit();
        }
    </script>
@endsection