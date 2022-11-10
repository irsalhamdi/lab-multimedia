@extends('lead.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Kategori Berita</h4>
            <p class="card-description">
            Form Tambah Kategori Berita
            </p>
            <form method="POST" action="{{ route('lead.news-category.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Kategori" required>
                </div>
                <a href="{{ route('lead.news-category') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection