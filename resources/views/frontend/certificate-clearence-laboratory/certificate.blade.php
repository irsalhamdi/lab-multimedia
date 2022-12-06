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
                <th style="font-size: 20px; font-weight: bold;">
                    <span>LABORATORIUM MULTIMEDIA DAN PEMROGRAMAN PERMAINAN</span><br>
                    <span style="margin-left: 3%;"></span>FAKULTAS ILMU KOMPUTER<br>
                    <span style="margin-left: 4%;"></span>UNIVERSITAS SRIWIJAYA <br>
                    <span style="font-family: sans-serif; font-size: 12px; margin-left: 2%; font-weight: normal">
                        Jl. Masjid Al Gazali, Bukit Lama,
                        Ilir Bar. I, Palembang, Sumatera Selatan, 30128
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
                    BEBAS LABORATORIUM
                </th>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td style="text-align: center">
                    No : .../K/J04.01/PP.12/{{ date('Y') }}
                </td>
            </tr>
        </table>

        <br><br>

        <table width="100%">
            <tr>
                <p style="font-family: sans-serif;">    
                    Yang bertanda tangan di bawah ini, Kepala Laboratorium Multimedia dan Pemrograman Permainan Fakultas Ilmu Komputer Universitas Sriwijaya, menerangkan bahwa :
                </p>
            </tr>
        </table>

        <table width="100%">
                <tr>
                    <p style="text-align: center; font-family: sans-serif;">    
                        Nama : {{ $user->name }} <br>
                        <span style="margin-left: 2%"></span> NIM : {{ $user->nim }} <br>
                        <span style="margin-left: 3%"></span> Jurusan : {{ $user->jurusan }}
                    </p>
                </tr>
        </table>

        <table width="100%">
                <tr>
                    <p style="text-align: justify; font-family: sans-serif;">
                        Benar Mahasiswa tersebut tidak mempunyai pinjaman berupa alat-alat Laboratorium Multimedia dan Pemrograman Permainan Fakultas Ilmu Komputer Universitas Sriwijaya. <br>
                        Demikianlah surat keterangan ini dibuat untuk dipergunakan seperlunya.
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
                    Kepala Laboratorium<br>
                    Multimedia dan Pemrograman Permainan <br><br><br><br><br><br><br><br><br>
                    Dr. Ali Ibrahim, S.Kom, M.T<br>
                     NIP : 198407212019031004
                </p>
            </tr>
        </table>

        <br>
    </body>
</html>