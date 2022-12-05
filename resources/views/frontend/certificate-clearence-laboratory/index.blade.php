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
                                <form method="POST" action="{{ route('mahasiswa.laboratory.clearance.certificate.submit') }}">
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
                                                <input type="text" name="address"  value="{{ old('address', $user->address) }}"placeholder="Alamat" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p>
                                                Dengan ini mengajukan permohonan untuk memiliki surat bebas Laboratorium Multimedia dan Pemrograman Permainan Fakultas Ilmu Komputer Universitas Sriwijaya
                                            </p>
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
                                    <p class="text-white">Silahkan login terlebih dahulu sebelum mendaftar !</p>
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
                                                <input type="text" name="address"  value="{{ old('address') }}"placeholder="Alamat" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p>
                                                Dengan ini mengajukan permohonan untuk memiliki surat bebas Laboratorium Multimedia dan Pemrograman Permainan Fakultas Ilmu Komputer Universitas Sriwijaya
                                            </p>
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