<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/unsri.png') }}">
        <title>Pengajuan Surat Keterangan Bebas Lab</title>
    </head>
    <body>

        <table width="100%">
            <tr>
                <th width="20">
                    <img src="{{ asset('frontend/img/unsri.png') }}" width="120%;">
                </th>
                <th style="font-size: 20px; font-weight: bold;" width="80">
                    UNIVERSITAS SRIWIJAYA<br>
                    FAKULTAS ILMU KOMPUTER<br>
                    LABORATORIUM KOMPUTER<br>
                    <span style="font-family: sans-serif; font-size: 12px; margin-left: 1%; font-weight: normal">
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
                    <u>PELAYANANAN MAHASISWA</u>
                </th>
            </tr>
        </table>

        <br><br>

        <table width="100%">
                <tr>
                    <p style="font-family: sans-serif;">    
                        Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->name }} <br>
                        NIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->nim }} <br>
                        Angkatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $certificate->generation }} <br>
                        Jurusan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->jurusan }} <br>
                        No. Hanphone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $user->phone }} <br>
                        Judul Tugas Akhir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $certificate->title_of_thesis }}<br> 
                        Dosen Pembimbing TA&nbsp;: {{ $certificate->dosen }}
                    </p>
                </tr>
        </table>

        <br>

        <table width="100%">
                <tr>
                    <b style="text-align: justify; font-family: sans-serif;">
                        KEPERLUAN
                    </b><br>
                    <span style="text-align: justify; font-family: sans-serif;">
                        Surat Keterangan Bebas Peminjaman Alat Laboratorium Untuk :
                    </span>
                    <span style="text-align: justify; font-family: sans-serif;">
                        {{ $certificate->necessity }}
                    </span>
                </tr>
        </table>

        <br><br>

        <table width="100%">
                <tr>
                    <b style="text-align: justify; font-family: sans-serif;">
                        LABORATORIUM
                    </b><br>
                </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td> 
                        @if ($certificate->basis_data === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Basis Data & Big Data
                        @else
                            Lab. Basis Data & Big Data
                        @endif
                    </td>
                    <td> 
                        @if ($certificate->instrumen === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Instrumen & Apk Nanoteknologi
                        @else
                            Lab. Instrumen & Apk Nanoteknologi
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->multimedia === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Multimedia & Pemrograman Game
                        @else
                            Lab. Multimedia & Pemrograman Game
                        @endif
                    </td>
                    <td>
                        @if ($certificate->kecerdasan === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Kecerdasan Buatan & Grafika Komp
                        @else
                            Lab. Kecerdasan Buatan & Grafika Komp
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->robotika === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Robotika, Sistem Kendali & Sistem Tertanam
                        @else
                            Lab. Robotika, Sistem Kendali & Sistem Tertanam
                        @endif
                    </td>
                    <td>
                        @if ($certificate->jaringan === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Jaringan Komputer & Komdat
                        @else
                            Lab. Jaringan Komputer & Komdat
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->elektronika === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Elektronika & Sistem Kendali
                        @else
                            Lab. Elektronika & Sistem Kendali
                        @endif
                    </td>
                    <td>
                        @if ($certificate->pengolahan === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Pengolahan Citra & Pengenalan Pola
                        @else
                            Lab. Pengolahan Citra & Pengenalan Pola
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->perangkat_keras === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Perangkat Keras & Teknologi Komponen
                        @else
                            Lab. Perangkat Keras & Teknologi Komponen
                        @endif
                    </td>
                    <td>
                        @if ($certificate->rpl === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. RPL & Sistem Informasi
                        @else
                            Lab. RPL & Sistem Informasi
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->struktur_data === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Struktur Data & SI Akuntansi
                        @else
                            Lab. Struktur Data & SI Akuntansi
                        @endif
                    </td>
                    <td>
                        @if ($certificate->pemrograman_dasar === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Pemrograman Dasar
                        @else
                            Lab. Pemrograman Dasar
                        @endif
                    </td>
                </span>
            </tr>
            <tr>
                <span style="text-align: justify; font-family: sans-serif;">
                    <td>
                        @if ($certificate->pemrograman_lanjut === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Pemrograman Lanjut
                        @else
                            Lab. Pemrograman Lanjut
                        @endif
                    </td>
                    <td>
                        @if ($certificate->pemrograman_internet === 1)
                            <img src="{{ asset('frontend/img/check.png') }}"> Lab. Pemrograman Internet
                        @else
                            Lab. Pemrograman Internet
                        @endif
                    </td>
                </span>
            </tr>
        </table>

        <br><br>

        <table width="100%">
            <tr>
                 @php
                    $date = date('d',strtotime(date('Y-m-d')));
                    $year = date('Y',strtotime(date('Y-m-d')));
                @endphp
                <p style="text-align: right; font-family: sans-serif;">
                    Palembang, {{ $date }}-{{ date('m') }}-{{ $year }}<br>
                    Pemohon<br>
                </p>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <img style="float: right;" src="{{ asset($certificate->signature) }}" width="100px;">
            </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
                <b style="float: right; font-family: sans-serif;">{{ $user->name }}</b><br>
            </tr>
        </table>

        <br>
    </body>
</html>