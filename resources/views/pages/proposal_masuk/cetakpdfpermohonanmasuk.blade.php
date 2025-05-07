<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Magang - {{ $rc->nomor_surat_permintaan }}</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12pt;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 12pt;
    }

    th, td {
        padding: 8px;
        text-align: left;
        vertical-align: top;
        font-family: Arial, sans-serif;
        font-size: 12pt;
    }

    h2, .sub-header, .page-header {
        text-align: center;
        font-size: 14pt;
        font-weight: bold;
        font-family: Arial, sans-serif;
    }

    .info-table td {
        padding: 5px;
    }

    .content-table, .content-table td {
        border: 1px solid black;
    }

    .content-table th {
        text-align: center;
        font-weight: bold;
        background-color: white;
    }

    .footer-table td {
        text-align: center;
    }

    .center {
        text-align: center;
    }

    p {
        font-family: Arial, sans-serif;
        font-size: 12pt;
    }
</style>
</head>
<body>
<div style="text-align: center;">
    <table>
        <tr>
            <td rowspan="1" width="100px" style="text-align: center; vertical-align: middle;">
                <img src="{{ asset('static/avatars/Jatim.png') }}" width="80px">
            </td>
            <td align="center" style="text-align: center; vertical-align: middle;">
                <div style="line-height: 1.15; font-family: Arial;">
                    PEMERINTAH PROVINSI JAWA TIMUR<br>
                    <b style="font-size:20px">DINAS KOMUNIKASI DAN INFORMATIKA</b><br>
                    Alamat : Jl. A. Yani  No. 242-244 Surabaya Telp. (031) 8294608<br>
                    Fax. (031) 8294517 Website : kominfo.jatimprov.go.id<br>
                    Email : kominfo@jatimprov.go.id<br>
                    <b><u>SURABAYA 60235</u></b>
                </div>
            </td>
        </tr>
    </table>
</div>

    <!-- Data Balasan -->
<table class="info-table" style="width: 100%;">
    <!-- Tanggal Surat -->
    <br>
    <tr>
        <td colspan="2" style="padding-left: 400px;">
            Surabaya, {{ \Carbon\Carbon::parse($balasan->tanggal_surat_balasan)->format('d F Y') ?? 'Tidak Tersedia' }}
        </td>
    </tr>

    <!-- Tujuan Surat -->
    <tr>
        <td colspan="2" style="padding-left: 400px;">
            Kepada Yth. Sdr. {{ $rc->ditandatangani_oleh }} {{ $rc->masterMgng->masterSklh->user->fullname }}<br>
            di<br>
            <b><u>TEMPAT</u></b>
        </td>
    </tr>

    <!-- Nomor -->
    <tr>
        <td style="width: 10%;">Nomor</td>
        <td>: 400.14.5.4/{{ $balasan->nomor_surat_balasan ?? 'Tidak Tersedia' }}/114.1/{{ \Carbon\Carbon::parse($rc->tanggal_surat_balasan)->format('Y') }}</td>
    </tr>

    <!-- Sifat -->
    <tr>
        <td>Sifat</td>
        <td>: {{ $balasan->sifat_surat_balasan ?? 'Tidak Tersedia' }}</td>
    </tr>

    <!-- Lampiran -->
    <tr>
        <td>Lampiran</td>
        <td>: 
            @if($balasan->lampiran_surat_balasan == 'selembar')
                1 (Satu Lembar)
            @else
                {{ $balasan->lampiran_surat_balasan ?? 'Tidak Tersedia' }}
            @endif
        </td>
    </tr>

    <!-- Perihal -->
    <tr>
        <td>Perihal</td>
        <td>: Permohonan Magang</td>
    </tr>
</table>


    <!-- Teks Pengantar -->
    <p style="text-align: justify; text-indent: 2em;">
        Sehubungan dengan surat Saudara tanggal {{ \Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }} nomor {{ $rc->nomor_surat_permintaan }}, perihal {{ $rc->perihal_surat_permintaan }}, bersama ini disampaikan bahwa Dinas Komunikasi dan Informatika Provinsi Jawa Timur menerima Permohonan Magang 
        @if($rc->jenis_sklh != 'ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif {{ $rc->name }}
        @if($rc->metode_magang == 'online') secara Daring/<i>Online</i> @endif atas nama:
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
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $peserta->nama_peserta }}</td>
                <td class="center">{{ $peserta->nis_peserta }}</td>
                <td class="center">{{ $peserta->program_studi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .content-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    .content-table th, .content-table td {
        border: 1px solid black;
        padding: 8px;
    }

    .content-table th {
        text-align: center;
        font-weight: bold;
        background-color: white;
    }

    .center {
        text-align: center;
    }
</style>


    <!-- Ketentuan Magang -->
    <p>Pelaksanaan magang diatur dalam ketentuan sebagai berikut :</p>
    <table>
        <tr><td>1. </td><td>Jadwal Magang dimulai tanggal {{ \Carbon\Carbon::parse($balasan->tanggal_awal_magang)->format('d F Y') }} s.d. {{ \Carbon\Carbon::parse($balasan->tanggal_akhir_magang)->format('d F Y') }};</td></tr>
        <tr><td>2. </td><td>Jam Kerja Magang dimulai pukul 08.00 s.d. 14.00 WIB;</td></tr>
        <tr><td>3. </td><td>{{ $rc->masterMgng->masterSklh->user->fullname }} mengupload Laporan @if($rc->jenis_sklh!='ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif Magang melalui Aplikasi sima.jatimprov.go.id.</td></tr>
    </table>

    <p>Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.</p>

    <!-- Footer -->
<table class="footer-table" style="width: 100%;">
    <tr>
        <td style="width: 60%;"></td>
        <td style="text-align: center;">
            a.n. KEPALA DINAS KOMUNIKASI DAN INFORMATIKA<br>
            PROVINSI JAWA TIMUR
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;">
            Sekretaris
        </td>
    </tr>
    <!-- Jarak kosong untuk tanda tangan -->
    <tr>
        <td></td>
        <td style="height: 60px;"></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;">
            <b><u>{{ $petugas->nama_pejabat }}</u></b>
            {{ $petugas->pangkat_pejabat }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;">
            NIP. {{ $petugas->nip_pejabat }}
        </td>
    </tr>
</table>
</body>
</html>
