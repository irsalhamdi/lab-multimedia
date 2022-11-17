@extends('admin.layouts.main')
@section('main')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Testimoni </h4>
                @if ($testimonies->count())
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Testimoni
                                    </th>
                                    <th>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonies as $testimoni)
                                    <tr>
                                        <td class="py-1">
                                            @if ($testimoni->admin_id !== null)
                                                {{$testimoni->admin->name }}
                                            @elseif($testimoni->asistant_id !== null)
                                                {{$testimoni->asistant->name }}
                                            @elseif($testimoni->dosen_id !== null)
                                                {{$testimoni->dosen->name }}
                                            @elseif($testimoni->lead_id !== null)
                                                {{$testimoni->lead->name }}
                                            @elseif($testimoni->user_id !== null)
                                                {{$testimoni->user->name }}
                                            @endif
                                        </td>
                                        <td class="py-1">
                                            {{ $testimoni->testimoni }}
                                        </td>
                                        <td>
                                            @if ($testimoni->status === 1)
                                                <form action="{{ route('admin.testimonies.unacc') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $testimoni->id }}">
                                                    <button type="submit" class="btn btn-dark btn-circle btn-sm justify-content-between flex-nowrap">
                                                        <i class="typcn typcn-cancel-outline"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.testimonies.acc') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $testimoni->id }}">
                                                    <button type="submit" class="btn btn-light btn-circle btn-sm justify-content-between flex-nowrap">
                                                        <i class="typcn typcn-adjust-contrast"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <p class="text-muted">Testimoni tidak di temukan</p>
                    </div>
                 @endif
                <div class="d-flex justify-content-center mt-3">
                    {{ $testimonies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection