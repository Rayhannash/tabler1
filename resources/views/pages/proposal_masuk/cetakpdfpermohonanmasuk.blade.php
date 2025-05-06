<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Magang - {{ $rc->nomor_surat_permintaan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        td {
            vertical-align: top;
        }
        h2, .sub-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .info-table td {
            padding: 5px;
        }
        .content-table, .content-table td {
            border: 1px solid black;
        }
        .content-table th {
            font-size: 16px;
            text-align: center;
        }
        .footer-table td {
            font-size: 14px;
            text-align: center;
        }
        .css-serial {
            counter-reset: serial-number;  
        }
        .css-serial td:first-child:before {
            counter-increment: serial-number;  
            content: counter(serial-number);  
            font-family: Arial;
        }
        .page-header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div style="text-align: center;">
    <table>
    <tr>
        <td rowspan="6" width="100px" style="text-align: center; vertical-align: middle;">
            <img src="{{ asset('dist/img/jatim.png') }}" width="80px">
        </td>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial">PEMERINTAH PROVINSI JAWA TIMUR</font>
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial"><b style="font-size:20px">DINAS KOMUNIKASI DAN INFORMATIKA</b></font>
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial">Alamat : Jl. A. Yani  No. 242-244 Surabaya Telp. (031) 8294608</font>
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial">Fax. (031) 8294517 Website : kominfo.jatimprov.go.id</font>
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial">Email : kominfo@jatimprov.go.id</font>
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center; vertical-align: middle;">
            <font face="Arial"><b><u>SURABAYA 60235</u></b></font>
        </td>
    </tr>
</table>

</div>


    <!-- Data Balasan -->
    <table class="info-table">
        <tr>
            <td><strong>Surabaya, {{ \Carbon\Carbon::parse($balasan->tanggal_surat_balasan)->format('d F Y') ?? 'Tidak Tersedia' }}</strong></td>
        </tr>
        <tr>
            <td><strong>Kepada Yth. Sdr. {{ $rc->ditandatangani_oleh }} {{ $rc->masterMgng->masterSklh->user->fullname }}</strong><br>di<br><b><u>TEMPAT</u></b></td>
        </tr>
        <tr>
            <td style="width: 25%;"><strong>Nomor :</strong></td>
            <td style="width: 75%;">400.14.5.4/{{ $balasan->nomor_surat_balasan ?? 'Tidak Tersedia' }}/114.1/{{ \Carbon\Carbon::parse($rc->tanggal_surat_balasan)->format('Y') }}</td>
        </tr>
        <tr>
            <td style="width: 25%;"><strong>Sifat :</strong></td>
            <td style="width: 75%;">{{ $balasan->sifat_surat_balasan ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td style="width: 25%;"><strong>Lampiran :</strong></td>
            <td style="width: 75%;">{{ $balasan->lampiran_surat_balasan ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td style="width: 25%;"><strong>Perihal :</strong></td>
            <td style="width: 75%;">Permohonan Magang</td>
        </tr>
    </table>

    <!-- Teks Pengantar -->
    <p style="text-indent: 2em">
        Sehubungan dengan surat Saudara tanggal {{ Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }} nomor {{$rc->nomor_surat_permintaan}}, perihal {{$rc->perihal_surat_permintaan}}, bersama ini disampaikan bahwa Dinas Komunikasi dan Informatika Provinsi Jawa Timur menerima Permohonan Magang @if($rc->jenis_sklh!='ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif {{$rc->name}}@if($rc->metode_magang=='online') secara Daring/<i>Online</i> @endif atas nama:
    </p>

    <table class="content-table">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Peserta</th>
            <th>NIS/NIM</th>
            <th>Program Studi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rd as $index => $peserta)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peserta->nama_peserta }}</td>
                <td>{{ $peserta->nis_peserta }}</td>
                <td>{{ $peserta->program_studi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .content-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse; /* Menghilangkan jarak antar border */
    }
    .content-table th, .content-table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
    }
    .content-table th {
        background-color: #f2f2f2;
    }
</style>

    <!-- Ketentuan Magang -->
    <p>Pelaksanaan magang diatur dalam ketentuan sebagai berikut :</p>
    <table>
        <tr>
            <td>1.</td>
            <td>Jadwal Magang dimulai tanggal {{ \Carbon\Carbon::parse($balasan->tanggal_awal_magang)->format('d F Y') }} s.d. {{ \Carbon\Carbon::parse($balasan->tanggal_akhir_magang)->format('d F Y') }};</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Jam Kerja Magang dimulai pukul 08.00 s.d. 14.00 WIB;</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>{{ $rc->masterMgng->masterSklh->user->fullname }} mengupload Laporan Siswa/Siswi Magang melalui Aplikasi sima.jatimprov.go.id.</td>
        </tr>
    </table>

    <p style="text-indent: 2em">Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.</p>

    <!-- Footer -->
    <table class="footer-table">
        <tr>
            <td></td><td align="center">a.n. KEPALA DINAS KOMUNIKASI DAN INFORMATIKA<br>PROVINSI JAWA TIMUR<br></td></td>
        </tr>
        <tr>
            <td></td><td align="center">Sekretaris</td>
        </tr>
        <tr>
            <td></td><td align="center"><b><u>{{ $petugas->nama_pejabat }}</u></b><br>{{ $petugas->pangkat_pejabat }}</td>
        </tr>
        <tr>
            <td></td><td align="center">NIP. {{ $petugas->nip_pejabat }}</td>
        </tr>
    </table>
</body>
</html>
