@extends('lead.layouts.main')
@section('main')
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Peserta</h4>
        <span style="float: right">
          <a href="{{ route('lead.training.participants.export', $training->id) }}" type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-arrow-forward-outline mr-2"></i>Export</a>
        </span>
        <p class="card-description">
            Daftar peserta pelatihan {{ $training->name }}<code><a href="">Tambah</a></code>
        </p>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  NIM 
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td class="py-1">
                            {{  $participant->user->name }}
                        </td>
                        <td>
                          {{ $participant->user->nim }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection