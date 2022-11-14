@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Faqs </h4>
            <p class="card-description">
                Daftar Faqs <code><a href="{{ route('admin.faq.add') }}">Tambah</a></code>
            </p>
            <form action="{{ route('admin.faqs') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Faqs" aria-label="Cari Faqs">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($faqs->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Pertanyaan
                            </th>
                            <th>
                                Jawaban
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <td class="py-1">
                                        {{$faq->ask }}
                                    </td>
                                    <td class="py-1">
                                        {{$faq->answer }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.faq.edit', $faq->id) }}" type="button" class="btn btn-warning btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.faq.delete', $faq->id) }}" type="button" class="btn btn-danger btn-circle btn-sm justify-content-between flex-nowrap">
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
                    <p class="text-muted">Faq tidak di temukan</p>
                </div>
            @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $faqs->links() }}
                </div>
        </div>
        </div>
    </div>
@endsection