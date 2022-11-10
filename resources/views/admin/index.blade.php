@extends('admin.layouts.main')
@section('main')
  <style>
  .card-body {
    -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
            flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
  }
  .news-style {
    font-weight: 600; 
    font-size: 32px; 
    line-height: 48px; 
    color: #0c0d36;
  }
  .news-style {
    font-size: 16px; 
    line-height: 24px; 
    color: #c5c5c5;
  }
  </style>
  <div class="row">
    <div class="col-xl-6 d-flex grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap justify-content-between">
            <h4 class="card-title news-title-style mb-3">Berita</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-flex mb-4">
                    <div class="news-style" style="">{{ $news }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 d-flex grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap justify-content-between">
            <h4 class="card-title news-title-style mb-3">Rilis</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-flex mb-4">
                    <div class="news-style" style="">{{ $release }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6 d-flex grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap justify-content-between">
            <h4 class="card-title news-title-style mb-3">Pelatihan</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-flex mb-4">
                    <div class="news-style" style="">{{ $training }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 d-flex grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap justify-content-between">
            <h4 class="card-title news-title-style mb-3">Mahasiswa</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-flex mb-4">
                    <div class="news-style" style="">{{ $users }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection