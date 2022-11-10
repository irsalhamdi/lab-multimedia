@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Kategori Pelatihan</h4>
            <p class="card-description">
            Form Tambah Kategori Pelatihan
            </p>
            <form method="POST" action="{{ route('asistant.training-category.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Kategori" required>
                </div>
                <a href="{{ route('asistant.training-category') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection