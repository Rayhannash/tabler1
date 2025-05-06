<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Magang - {{ $rc->nomor_surat_permintaan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 21cm;
            height: 33cm;
            margin-left: auto;
            margin-right: auto;
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
        p {
            font-size: 16px;
            text-align: justify;
        }
        th {
            font-size: 16px;
        }
        .css-serial {
            counter-reset: serial-number;  
        }
        .css-serial td:first-child:before {
            counter-increment: serial-number;  
            content: counter(serial-number);  
            font-family: Arial;
        }
    </style>
</head>
<body onload="window.print();">
    <!-- Header -->
    <table>
        <tr>
            <td rowspan="6" width="100px">
                <img src="{{url('img/jatim.png')}}" width="80px">
            </td>
            <td align="center"><font face="Arial">PEMERINTAH PROVINSI JAWA TIMUR</font></td>
        </tr>
        <tr>
            <td align="center"><font face="Arial"><b style="font-size:20px">DINAS KOMUNIKASI DAN INFORMATIKA</b></font></td>
        </tr>
        <tr>
            <td align="center"><font face="Arial">Alamat : Jl. A. Yani  No. 242-244 Surabaya Telp. (031) 8294608</font></td>
        </tr>
        <tr>
            <td align="center"><font face="Arial">Fax. (031) 8294517 Website : kominfo.jatimprov.go.id</font></td>
        </tr>
        <tr>
            <td align="center"><font face="Arial">Email : kominfo@jatimprov.go.id</font></td>
        </tr>
        <tr>
            <td align="center"><font face="Arial"><b><u>SURABAYA 60235</u></b></font></td>
        </tr>
    </table>

    <!-- Surat Permohonan Magang -->
    <div class="page-header">
        <h2>Permohonan Magang</h2>
        <p>Nomor: {{ $rc->nomor_surat_permintaan }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }}</p>
    </div>

    <!-- Data Balasan -->
    <div class="sub-header">Data Balasan</div>
    <table class="info-table">
        <tr>
            <td><strong>Nomor Surat Balasan</strong></td>
            <td>{{ $balasan->nomor_surat_balasan ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Surat Balasan</strong></td>
            <td>{{ \Carbon\Carbon::parse($balasan->tanggal_surat_balasan)->format('d F Y') ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Sifat Surat Balasan</strong></td>
            <td>{{ $balasan->sifat_surat_balasan ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Metode Magang</strong></td>
            <td>{{ $balasan->metode_magang ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Lampiran Surat Balasan</strong></td>
            <td>{{ $balasan->lampiran_surat_balasan ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Awal Magang</strong></td>
            <td>{{ \Carbon\Carbon::parse($balasan->tanggal_awal_magang)->format('d F Y') ?? 'Tidak Tersedia' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Akhir Magang</strong></td>
            <td>{{ \Carbon\Carbon::parse($balasan->tanggal_akhir_magang)->format('d F Y') ?? 'Tidak Tersedia' }}</td>
        </tr>
    </table>

    <!-- Teks Pengantar -->
    <p style="text-indent: 2em">
        Sehubungan dengan surat Saudara tanggal {{ Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }} nomor {{$rc->nomor_surat_permintaan}}, perihal {{$rc->perihal_surat_permintaan}}, bersama ini disampaikan bahwa Dinas Komunikasi dan Informatika Provinsi Jawa Timur menerima Permohonan Magang @if($rc->jenis_sklh!='ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif {{$rc->name}}@if($rc->metode_magang=='online') secara Daring/<i>Online</i> @endif atas nama:
    </p>

    <!-- Daftar Peserta -->
    <div class="sub-header">Daftar Peserta</div>
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

    <!-- Ketentuan Magang -->
    <div class="sub-header">Pelaksanaan Magang</div>
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
            <td>{{ $rc->name }} mengupload Laporan Magang melalui Aplikasi sima.jatimprov.go.id.</td>
        </tr>
    </table>

    <p style="text-indent: 2em">Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.</p>

    <!-- Footer -->
    <div class="sub-header">Penandatangan</div>
    <table class="footer-table">
        <tr>
            <td></td><td align="center">Sekretaris</td>
        </tr>
        <tr>
            <td></td><td align="center"><b><u>{{ $rc->nama_pejabat }}</u></b><br>{{ $rc->pangkat_pejabat }}</td>
        </tr>
        <tr>
            <td></td><td align="center">NIP. {{ $rc->nip_pejabat }}</td>
        </tr>
    </table>
</body>
</html>
