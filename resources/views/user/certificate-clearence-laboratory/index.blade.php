@extends('user.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SK Bebas Lab</h4>
                <p class="card-description">
                    Surat Keterangan Bebas Laboratorium
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Surat 
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    SK Bebas Lab
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('mahasiswa.laboratory.clearance.certificate.detail') }}" type="button" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                        <i class="typcn typcn-eye-outline"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection