@extends('dosen.layouts.main')
@section('main')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Panduan pengabdian</h4>
                <form method="POST" action="{{ route('dosen.community.dedication.upload.guide', $dedication->id) }}" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Upload Panduan Pengabdian {{ $dedication->name }}
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            @if ($guide)
                                <div class="container">
                                    <p align="center">
                                        <iframe type="application/pdf" src="{{ asset('upload/dedication/guide/'.$guide->file) }}" height="600" style="width: 100%;"></iframe>
                                    </p>
                                </div>
                            @else
                                <img src="{{ asset('backend/images/material.jpg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 100px; height: 100px;">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Panduan</label>
                                <div class="col-sm-9">
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required />
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    @if ($guide)
                                        <a target="_blank" href="{{ asset('upload/dedication/guide/'.$guide->file) }}">Download</a>
                                        <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2" style="float: right;">Update</button>
                                    @else
                                        <button type="submit" formnovalidate="formnovalidate" class="btn btn-primary mr-2" style="float: right;">Tambah</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection