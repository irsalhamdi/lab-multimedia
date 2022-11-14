@extends('admin.layouts.main')
@section('main')
    @php
        $date = date('d',strtotime($research->created_at));
        $month = date('F',strtotime($research->created_at));
        $year = date('Y',strtotime($research->created_at));
        $hour = date('H:i',strtotime($research->created_at));
    @endphp
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="card-title">{{ $research->title }}</h4>
                        <p class="card-description">
                            <i class="typcn typcn-time"></i> 
                            <code>{{ $date }} {{ Str::substr($month, 0, 3) }} {{ $year }}</code> 
                        </p>
                        <div class="template-demo">
                            <div class="container">
                                <p align="center">
                                    <iframe type="application/pdf" src="{{ asset($research->image) }}" height="600" style="width: 100%;"></iframe>
                                </p>
                            </div>
                            {!! $research->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Konfirmasi Penelitian</h4>
            <p class="card-description">
            Form Konfirmasi Penelitian Mahasiswa
            </p>
            <form method="POST" action="{{ route('admin.research.confirmation', $research->id) }}">
                @csrf
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="" selected="" disabled="">
                            Pilih status
                        </option>
                        <option value="1">Acc</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Informasi Tambahan</label>
                    <textarea name="information" class="form-control" rows="10" cols="80" required>
                        {{ old('information', $research->information) }}
                    </textarea>
                    @error('information')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <a href="{{ route('admin.research') }}" class="btn btn-light">Cancel</a>
                @if ($research->status === 0)
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                @else                    
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                @endif
            </form>
        </div>
        </div>
    </div>
@endsection