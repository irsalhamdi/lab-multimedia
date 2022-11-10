@extends('asistant.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Kategori Rilis</h4>
            <p class="card-description">
            Form Edit Kategori Rilis
            </p>
            <form method="POST" action="{{ route('asistant.release-category.update', $category->id) }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Nama Kategori" required>
                </div>
                <a href="{{ route('asistant.release-category') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
        </div>
    </div>
@endsection