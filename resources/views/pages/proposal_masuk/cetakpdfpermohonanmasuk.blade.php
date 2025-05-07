<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Magang - {{ $rc->nomor_surat_permintaan }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
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
        @media print {
            body {
                margin: 0;
                padding: 0;
                zoom: 0.75; /* Skala agar muat 1 halaman */
                font-size: 12px;
            }

            @page {
                size: A4 portrait;
                margin: 1.5cm;
            }

            table, p {
                page-break-inside: avoid;
            }

            html, body {
                height: auto;
                overflow: hidden;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
<div style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.2; overflow: auto;">
    <div style="float: left; margin-right: 10px;">
        <img src="dist/img/jatim.png" width="80px" style="vertical-align: middle;">
    </div>
    <div style="text-align: center;">
        <p style="margin: 0;">PEMERINTAH PROVINSI JAWA TIMUR</p>
        <p style="margin: 0; font-weight: bold;">DINAS KOMUNIKASI DAN INFORMATIKA</p>
        <p style="margin: 0;">Alamat : Jl. A. Yani No. 242-244 Surabaya Telp. (031) 8294608</p>
        <p style="margin: 0;">Fax. (031) 8294517 Website : kominfo.jatimprov.go.id</p>
        <p style="margin: 0;">Email : kominfo@jatimprov.go.id</p>
        <p style="margin: 0; text-decoration: underline;"><strong>SURABAYA 60235</strong></p>
    </div>
</div>


    <!-- Data Balasan -->
<table class="info-table" style="width: 100%; margin-top: 30px;">
    <tr>
        <td style="text-align: left; width: 50%;">
            <strong>Nomor :</strong> 400.14.5.4/1234567833/114.1/2025<br>
            <strong>Sifat :</strong> segera<br>
            <strong>Lampiran :</strong> selembar<br>
            <strong>Perihal :</strong> Permohonan Magang
        </td>
        <td style="text-align: right; width: 50%; padding-left: 20px;">
                Surabaya, 06 May 2025<br>
                Kepada Yth. Sdr. <br>
                Koordinator Sistem <br>
                Informasi UNAIR <br>
                di <br>
                <strong style="text-decoration: underline;">TEMPAT</strong>

        </td>
    </tr>
</table>


    <!-- Teks Pengantar -->
    <p style="text-indent: 2em; margin-top: 20px; font-size: 14px;">
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

    <!-- Ketentuan Magang -->
    <p style="margin-top: 20px; font-size: 14px;">Pelaksanaan magang diatur dalam ketentuan sebagai berikut :</p>
    <table style="margin-top: 10px; font-size: 14px;">
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

    <p style="text-indent: 2em; margin-top: 20px; font-size: 14px;">Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.</p>

    <!-- Footer -->
    <table class="footer-table" style="margin-top: 30px; width: 100%; border-collapse: collapse;">
    <tr>
        <td style="width: 50%;"></td>
        <td align="right">a.n. KEPALA DINAS KOMUNIKASI DAN INFORMATIKA<br>PROVINSI JAWA TIMUR<br>Sekretaris</td>
    </tr>
    <tr>
        <td colspan="2" style="padding-top: 50px;"></td>
    </tr>
    <tr>
        <td style="width: 50%;"></td>
        <td align="right" style="padding-right: 10px;">
                <b><u>{{ $petugas->nama_pejabat }}</u></b><br>
                {{ $petugas->pangkat_pejabat }}<br>
                NIP. {{ $petugas->nip_pejabat }}
        </td>
    </tr>
</table>
</body>
</html>