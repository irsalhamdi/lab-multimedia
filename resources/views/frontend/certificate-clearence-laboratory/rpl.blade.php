<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Surat Keterangan Bebas Lab</title>
    </head>
    <body>

        <table width="100%" >
            <tr>
                <th width="20">
                    <img src="{{ asset('frontend/img/unsri.png') }}" width="120%;">
                </th>
                <th style="font-size: 20px; font-weight: bold;" width="80">
                    UNIVERSITAS SRIWIJAYA<br>
                    FAKULTAS ILMU KOMPUTER<br>
                    LABORATORIUM KOMPUTER<br>
                    <span style="font-family: sans-serif; font-size: 12px; margin-left: 2%; font-weight: normal">
                        Jl. Palembang-Prabumulih Km, 32 Inderalaya Ogan Ilir Kode Pos 30662
                    </span><br>
                    <span style="font-family: sans-serif; font-size: 12px; margin-left: 2%; font-weight: normal">
                        Telp, 379249, Fax. 0711 37924, 581710 Pos-el: <span style="color: darkcyan">Humas@ilkom.unsri.ac.id</span> 
                    </span>
                </th>
            </tr>

        </table>

        <hr style="border: 1px solid;">

        <table width="100%" style="background:white; padding:2px;"></table>

        <br/>

        <table width="100%">
            <tr>
                <th>
                    SURAT KETERANGAN <br>
                    BEBAS PEMINJAMAN ALAT LABORATORIUM
                </th>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td style="text-align: center">
                    No : 110B/UN9.1.9/Lab/{{ date('Y') }}
                </td>
            </tr>
        </table>

        <br><br>

        <table width="100%">
            <tr>
                <p style="font-family: sans-serif;">    
                    Dengan ini menerangkan bahwa:
                </p>
            </tr>
        </table>

        <table width="100%">
                <tr>
                    <p style="font-family: sans-serif;">    
                        Nama &nbsp; &nbsp; &nbsp; : {{ $user->name }} <br>
                        NIM &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{ $user->nim }} <br>
                        Angkatan : {{ $certificate->generation }} <br>
                        Jurusan &nbsp;&nbsp;: {{ $user->jurusan }}
                    </p>
                </tr>
        </table>

        <table width="100%">
                <tr>
                    <p style="text-align: justify; font-family: sans-serif;">
                        Menurut catatan/pengamatan kami, mahasiswa tersebut sudah tidak mempunyai pinjaman 
                        alat-alat pada <b>Laboratorium RPL & Sistem Informasi</b> di Fakultas Ilmu Komputer Universitas
                        Sriwijaya. Oleh karena itu, surat ini dapat di pergunakan mahasiswa tersebut untuk
                        keperluan <b><i>Ujian Akhir Sidang / Komprehensif / Yudisium</i>.</b>
                        Surat keterangan ini berlau selama 6 bulan sejak tanggal di keluarkan
                    </p>
                </tr>
        </table>

        <table width="100%">
                <tr>
                    <p style="text-align: justify; font-family: sans-serif;">
                        Surat keterangan ini berlau selama 6 bulan sejak tanggal di keluarkan.
                    </p>
                </tr>
        </table>

        <br><br><br>

        <table width="100%">
            <tr>
                 @php
                    $date = date('d',strtotime(date('Y-m-d')));
                    $year = date('Y',strtotime(date('Y-m-d')));
                @endphp
                <p style="text-align: right; font-family: sans-serif;">
                    Palembang, {{ $date }}-{{ date('m') }}-{{ $year }}<br>
                    a.n Kepala Laboratorium<br>
                    Admin Laboratorium <br>
                </p>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <img style="float: right;" src="{{ asset('frontend/img/qr-code.png') }}" width="100px;">
            </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
                <b style="float: right; font-family: sans-serif;">CAKRO PRANOLO</b><br>
                <span style="float: right; font-family: sans-serif;">NIP : 19820318 201409 1 001</span>
            </tr>
        </table>

        <br>
    </body>
</html>