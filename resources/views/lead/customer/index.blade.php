@extends('lead.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kustomer </h4>
            <span style="float: right" class="mb-3">
                <a href="{{ route('lead.send.all-news-letter') }}" type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-mail mr-2"></i>Kirim Update Berita</a>
            </span>
            <p class="card-description mb-3">
                Daftar Kustomer 
            </p>
            <form action="{{ route('lead.customer') }}">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari Kustomer" aria-label="Cari Mahasiswa">
                    <div class="input-group-append">
                      <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                    </div>
                  </div>
                </div>
            </form>
            @if ($customers->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Email
                            </th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="py-1">
                                        {{$customer->email }}
                                    </td>
                                    <td>
                                        <a href="{{ route('lead.send.news-letter', $customer->id) }}" type="button" class="btn btn-link btn-circle btn-sm justify-content-between flex-nowrap">
                                            <i class="typcn typcn-mail"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <p class="text-muted">Kustomer tidak di temukan</p>
                </div>
            @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $customers->links() }}
                </div>
        </div>
        </div>
    </div>
@endsection