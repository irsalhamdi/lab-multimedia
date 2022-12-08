@extends('user.layouts.main')
@section('main')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Ujian TA</h4>
                <p class="card-description">
                    Form Ujian Tugas Akhir
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <p align="center">
                                <iframe type="application/pdf" src="{{ asset('upload/form_ta/'.$certificate->form_ta) }}" height="600" style="width: 100%;"></iframe>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection