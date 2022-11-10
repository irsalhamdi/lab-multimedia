@extends('lead.layouts.main')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Kontak</h4>
                <p class="card-description">
                Form Edit Kontak
                </p>
                <form method="POST" action="{{ route('lead.contact.update') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="province_id" class="form-control" required>
                            <option selected="" disabled="">
                                Pilih provinsi
                            </option>
                            @foreach ($provinces as $province)
                                @if (old('province_id') == $province->id)
                                    <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                                @else
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <select name="regency_id" class="form-control" required>
                            <option value="" selected="" disabled="">
                                Pilih kabupaten
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kecematan</label>
                        <select name="district_id" class="form-control" required>
                            <option value="" selected="" disabled="">
                                Pilih kecamatan 
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Desa</label>
                        <select name="village_id" class="form-control" required>
                            <option value="" selected="" disabled="">
                                Pilih desa 
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="number" name="zip_code" value="{{ old('zip_code', $contact->zip_code) }}" class="form-control @error('zip_code') is-invalid @enderror" placeholder="Kode Pos" required>
                        @error('zip_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="address" value="{{ old('address', $contact->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" required>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="number" name="phone" value="{{ old('phone', $contact->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="No Handphone" required>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('lead.dashboard') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="province_id"]').on('change', function(){
                var province_id = $(this).val();
                if(province_id) {
                    $.ajax({
                        url: "{{  url('/lead/get-regency/ajax') }}/"+province_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('select[name="district_id"]').empty(); 
                            $('select[name="village_id"]').empty(); 
                        var d =$('select[name="regency_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="regency_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="regency_id"]').on('change', function(){
                var regency_id = $(this).val();
                if(regency_id) {
                    $.ajax({
                        url: "{{  url('/lead/get-district/ajax') }}/" + regency_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                        var d =$('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                if(district_id) {
                    $.ajax({
                        url: "{{  url('/lead/get-village/ajax') }}/" + district_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                        var d =$('select[name="village_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="village_id"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection