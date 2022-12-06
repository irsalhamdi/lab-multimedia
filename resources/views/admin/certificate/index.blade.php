@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab </h4>
                <p class="card-description">
                    Surat Keterangan Bebas Laboratorium
                </p>
                @if ($certificates->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificates as $certificate)
                                    <tr>
                                        <td class="py-1">
                                            {{ $certificate->user->name }}
                                        </td>
                                        <td>
                                            <a target="_blank"href="{{ route('admin.laboratory.clearance.certificate.detail', $certificate->id) }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                                <i class="typcn typcn-eye-outline"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <p class="text-muted">SK Bebas Lab tidak di temukan</p>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $certificates->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection