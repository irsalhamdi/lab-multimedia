@extends('frontend.layouts.main')
@section('main')
    <link rel="stylesheet" href="../libs/css/bootstrap.v3.3.6.css">
    <script type="text/javascript" src="{{ asset('frontend/js/signature.js') }}"></script>
    @if (Auth::user())
        <div ata-scroll-index='1' class="admission_area">
            <div class="admission_inner">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-7">
                            <div class="admission_form">
                                <h3>Pengajuan SK Bebas Laboratorium</h3>
                                <form method="POST" action="{{ route('mahasiswa.laboratory.clearance.certificate.submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Alamat Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="nim"  value="{{ old('nim', $user->nim) }}"placeholder="NIM" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="jurusan"  value="{{ old('jurusan', $user->jurusan) }}"placeholder="Jurusan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="phone"  value="{{ old('phone', $user->phone) }}"placeholder="Nomor Handphone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="generation" class="@error('generation') is-invalid @enderror" value="{{ old('generation') }}" placeholder="Angkatan" required>
                                                @error('generation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="title_of_thesis" class="@error('title_of_thesis') is-invalid @enderror" value="{{ old('title_of_thesis') }}"placeholder="Judul Tugas Akhir" required>
                                                @error('title_of_thesis')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="dosen" class="@error('dosen') is-invalid @enderror" value="{{ old('dosen') }}" placeholder="Dosen Pembimbing Tugas Akhir" required>
                                                @error('dosen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single_input">
                                                <input type="text" name="necessity" class="@error('necessity') is-invalid @enderror" value="{{ old('necessity') }}"placeholder="Keperluan" required>
                                                @error('necessity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>          
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="basis_data" id="checkbox_1" value="1" {{ old('basis_data') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_1">Basis Data & Big Data</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="instrumen" id="checkbox_2" value="1" {{ old('instrumen') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_2">Instrumen & Apk Nanoteknologi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="multimedia" id="checkbox_3" value="1" {{ old('multimedia') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_3">Multimedia & Pemrograman Permainan</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="kecerdasan" id="checkbox_4" value="1" {{ old('kecerdasan') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_4">Kecerdasan Buatan & Grafika Komp</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="robotika" id="checkbox_5" value="1" {{ old('robotika') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_5">Robotika, Sistem Kendali & Tertanam</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="jaringan" id="checkbox_6" value="1" {{ old('jaringan') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_6">Jaringan Komputer & Komdat</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="elektronika" id="checkbox_7" value="1" {{ old('elektronika') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_7">Elektronika & Sistem Digital</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pengolahan" id="checkbox_8" value="1" {{ old('pengolahan') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_8">Pengolahan Citra & Pengenalan Pola</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="perangkat_keras" id="checkbox_9" value="1" {{ old('perangkat_keras') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_9">Perangkat Keras & Teknologi Komponen</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="rpl" id="checkbox_10" value="1" {{ old('rpl') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_10">RPL & Sistem Informasi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="struktur_data" id="checkbox_11" value="1" {{ old('struktur_data') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_11">Struktur Data & SI Akuntansi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pemrograman_dasar" id="checkbox_12" value="1" {{ old('pemrograman_dasar') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_12">Pemrograman Dasar</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pemrograman_lanjut" id="checkbox_13" value="1" {{ old('pemrograman_lanjut') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_13">Pemrograman Lanjut</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pemrograman_internet" id="checkbox_14" value="1" {{ old('pemrograman_internet') == '1' ? 'checked' : '' }}/>
                                                <label for="checkbox_14">Pemrograman Internet</label>
                                            </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy KPM</p>
                                                </div>
                                                <input type="file" name="kpm" class="@error('kpm') is-invalid @enderror" required>
                                                @error('kpm')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Form Ujian TA</p>
                                                </div>
                                                <input type="file" name="form_ta" class="@error('form_ta') is-invalid @enderror" required>
                                                @error('form_ta')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Tanda Terima Proposal</p>
                                                </div>
                                                <input type="file" name="form_proposal" class="@error('form_proposal') is-invalid @enderror" required>
                                                @error('form_proposal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>       
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Pengesahan KP</p>
                                                </div>
                                                <input type="file" name="form_pengesahan_kp" class="@error('form_pengesahan_kp') is-invalid @enderror" required>
                                                @error('form_pengesahan_kp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Laporan KP</p>
                                                </div>
                                                <input type="file" name="form_kp" class="@error('form_kp') is-invalid @enderror" required>
                                                @error('form_kp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>           
                                        <div class="col-md-12">
                                            <div id="signature-pad">
                                                <div style="border:solid 3px rgb(255, 255, 255); width:300px; height:110px; padding:3px; position:relative;">
                                                    <div id="note" onmouseover="my_function();"></div>
                                                    <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Silahkan tanda tangan di atas</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="apply_btn">
                                                <button class="boxed-btn3" type="submit">Daftar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    @else
        <div ata-scroll-index='1' class="admission_area">
            <div class="admission_inner">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-7">
                            <div class="admission_form">
                                <h3>Pengajuan SK Bebas Laboratorium</h3>
                                <form method="POST" action="{{ route('mahasiswa.laboratory.clearance.certificate.submit') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="nim"  value="{{ old('nim') }}"placeholder="NIM" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="jurusan"  value="{{ old('jurusan') }}"placeholder="Jurusan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="phone"  value="{{ old('phone') }}"placeholder="Nomor Handphone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="number" name="generation"  value="{{ old('generation') }}"placeholder="Angkatan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="title_of_thesis"  value="{{ old('title_of_thesis') }}"placeholder="Judul Tugas Akhir" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <input type="text" name="dosen"  value="{{ old('dosen') }}"placeholder="Dosen Pembimbing Tugas Akhir" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single_input">
                                                <input type="text" name="necessity"  value="{{ old('necessity') }}" placeholder="Keperluan" required>
                                            </div>
                                        </div>          
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="basis_data" id="checkbox_1" value="1" />
                                                <label for="checkbox_1">Basis Data & Big Data</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="instrumen" id="checkbox_2" value="1" />
                                                <label for="checkbox_2">Instrumen & Apk Nanoteknologi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="multimedia" id="checkbox_3" value="1" />
                                                <label for="checkbox_3">Multimedia & Pemrograman Permainan</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="kecerdasan" id="checkbox_4" value="1" />
                                                <label for="checkbox_4">Kecerdasan Buatan & Grafika Komp</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="robotika" id="checkbox_5" value="1" />
                                                <label for="checkbox_5">Robotika, Sistem Kendali & Tertanam</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="jaringan" id="checkbox_6" value="1" />
                                                <label for="checkbox_6">Jaringan Komputer & Komdat</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="elektronika" id="checkbox_7" value="1" />
                                                <label for="checkbox_7">Elektronika & Sistem Digital</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pengolahan" id="checkbox_8" value="1" />
                                                <label for="checkbox_8">Pengolahan Citra & Pengenalan Pola</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="perangkat_keras" id="checkbox_9" value="1" />
                                                <label for="checkbox_9">Perangkat Keras & Teknologi Komponen</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="rpl" id="checkbox_10" value="1" />
                                                <label for="checkbox_10">RPL & Sistem Informasi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="struktur_data" id="checkbox_11" value="1" />
                                                <label for="checkbox_11">Struktur Data & SI Akuntansi</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pemrograman_dasar" id="checkbox_12" value="1" />
                                                <label for="checkbox_12">Pemrograman Dasar</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="pemrograman_internet" id="checkbox_13" value="1" />
                                                <label for="checkbox_13">Pemrograman Lanjut</label>
                                            </div>
                                        </div>        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" name="hot_deals" id="checkbox_14" value="1" />
                                                <label for="checkbox_14">Pemrograman Internet</label>
                                            </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy KPM</p>
                                                </div>
                                                <input type="file" name="form_ta" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Form Ujian TA</p>
                                                </div>
                                                <input type="file" name="form_proposal" required>
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Tanda Terima Proposal</p>
                                                </div>
                                                <input type="file" name="form_proposal" required>
                                            </div>
                                        </div>       
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Pengesahan KP</p>
                                                </div>
                                                <input type="file" name="form__pengesahan_kp" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">Fotocopy Laporan KP</p>
                                                </div>
                                                <input type="file" name="form_kp" required>
                                            </div>
                                        </div>      
                                        <div class="col-md-12">
                                            <div class="single_input">
                                                <div class="apply_btn">
                                                    <p class="text-white">KPM</p>
                                                </div>
                                                <input type="file" name="kpm" required>
                                            </div>
                                        </div>      
                                        <div class="col-md-12">
                                            <div id="signature-pad">
                                                <div style="border:solid 3px rgb(255, 255, 255); width:300px; height:110px; padding:3px; position:relative;">
                                                    <div id="note" onmouseover="my_function();"></div>
                                                    <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Silahkan tanda tangan di atas</p>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="apply_btn">
                                                <button class="boxed-btn3" type="submit">Daftar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    @endif
    <script>
        var wrapper = document.getElementById("signature-pad");
        var clearButton = wrapper.querySelector("[data-action=clear]");
        var savePNGButton = wrapper.querySelector("[data-action=save-png]");
        var canvas = wrapper.querySelector("canvas");
        var el_note = document.getElementById("note");
        var signaturePad;
        signaturePad = new SignaturePad(canvas);
        clearButton.addEventListener("click", function (event) {
            document.getElementById("note").innerHTML="";
            signaturePad.clear();
        });
        savePNGButton.addEventListener("click", function (event){
            if (signaturePad.isEmpty()){
                alert("Please provide signature first.");
                event.preventDefault();
            }else{
                var canvas  = document.getElementById("the_canvas");
                var dataUrl = canvas.toDataURL();
                document.getElementById("signature").value = dataUrl;
            }
        });
        function my_function(){
            document.getElementById("note").innerHTML="";
        }
    </script>
@endsection