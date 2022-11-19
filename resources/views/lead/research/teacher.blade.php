@extends('lead.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Penelitian Dosen</h4>
            <form action="{{ route('lead.research.teacher') }}">
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
                                Nama
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
                                        {{$research->dosen->name }}
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
                                        <a href="" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                            <i class="typcn typcn-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $result = App\Models\ResearchResultTeacher::where('research_teacher_id', $research->id)->first();
                                        @endphp
                                        @if ($result)
                                            <a target="_blank" href="{{ asset('upload/research-teacher/result/'.$result->file) }}" type="button" class="btn btn-primary btn-circle btn-sm justify-content-between flex-nowrap" style="margin-left: 2px; margin-right: 2px; margin-top: 2px; margin-bottom: 2px;">
                                                <i class="typcn typcn-upload"></i>
                                            </a>
                                        @else
                                            Belum Tersedia
                                        @endif
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