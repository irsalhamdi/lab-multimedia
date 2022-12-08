@extends('user.layouts.main')
@section('main')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Tanda Terima Proposal</h4>
                <p class="card-description">
                    Form Tanda Terima Proposal
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">
                            <p align="center">
                                <iframe type="application/pdf" src="{{ asset('upload/form_proposal/'.$certificate->form_proposal) }}" height="600" style="width: 100%;"></iframe>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection