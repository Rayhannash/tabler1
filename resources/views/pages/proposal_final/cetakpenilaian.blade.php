<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Penilaian - {{ $rc->nama_peserta }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 10px 20px;
            line-height: 1.2;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 4px 6px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
        }
        .no-border {
            border: none;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            font-size: 13px;
            line-height: 1.1;
        }
        .header img {
            width: 70px;
            height: auto;
            margin-bottom: 3px;
        }
        h2 {
            margin: 10px 0 8px;
            font-size: 16px;
        }
        /* Reduce vertical spacing around paragraphs inside notes */
        p {
            margin: 3px 0;
        }
        /* Container catatan */
        .catatan {
            border: 1px solid black;
            padding: 8px;
            max-width: 1000px;
            margin: 8px 0;
            font-size: 11px;
        }
        /* Signature table adjustments */
        table.signature {
            border: none;
            margin-top: 8px;
        }
        table.signature td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="dist/img/jatim.png" alt="logo">
        <p><strong>PEMERINTAH PROVINSI JAWA TIMUR</strong></p>
        <p><strong>DINAS KOMUNIKASI DAN INFORMATIKA</strong></p>
        <p>Jl. A. Yani No. 242-244 Surabaya Telp. (031) 8294608</p>
        <p>Website: kominfo.jatimprov.go.id | Email: kominfo@jatimprov.go.id</p>
        <p><strong><u>SURABAYA 60235</u></strong></p>
    </div><br>

    <h2 style="text-align: center;">PENILAIAN PESERTA MAGANG</h2>

    <table class="no-border" width="100%">
        <tr><td>Nama</td><td>{{ $rc->nama_peserta }}</td></tr>
        <tr><td>@if($rc->jenis_sklh != 'ptg') NIS @else NIM @endif</td><td>{{ $rc->nis_peserta }}</td></tr>
        <tr><td>Universitas</td><td>{{ $rc->permintaan->masterMgng->masterSklh->user->fullname ?? '-' }}</td></tr>
        <tr><td>Lokasi Magang</td><td>Dinas Komunikasi dan Informatika Jawa Timur</td></tr>
        <tr><td>Unit/Bagian</td><td>{{ ($rc->notaDinas->masterBdng)->nama_bidang ?? 'Belum ditempatkan' }}</td></tr>
        <tr><td>Periode Magang</td><td>{{ \Carbon\Carbon::parse(optional($rc->permintaan->balasan)->tanggal_awal_magang ?? now())->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse(optional($rc->permintaan->balasan)->tanggal_akhir_magang ?? now())->translatedFormat('d F Y') }}</td></tr>
    </table><br>

    <table>
        <thead>
            <tr>
                <th colspan="2">Aspek yang dinilai</th>
                <th style="text-align:center">Bobot (%)</th>
                <th style="text-align:center">Skor<br>(40-100)</th>
                <th style="text-align:center">Nilai<br>(Bobot x Skor)</th>
            </tr>
        </thead>
        <tbody>
            <tr><th colspan="5" style="text-align:left;">Personal</th></tr>
            <tr>
                <td>1.</td><td>Kedisiplinan (kehadiran, ketepatan waktu, kepatuhan pada tata tertib)</td><td align="center">10</td><td align="center">{{ $rc->nilai_kedisiplinan }}</td><td align="center">{{ number_format($rc->nilai_kedisiplinan * 0.1,2) }}</td>
            </tr>
            <tr>
                <td>2.</td><td>Tanggung Jawab (bertanggung jawab atas penyelesaian tugas)</td><td align="center">10</td><td align="center">{{ $rc->nilai_tanggungjawab }}</td><td align="center">{{ number_format($rc->nilai_tanggungjawab * 0.1,2) }}</td>
            </tr>
            <tr>
                <td>3.</td><td>Kerjasama (kemampuan bekerja dalam kelompok)</td><td align="center">10</td><td align="center">{{ $rc->nilai_kerjasama }}</td><td align="center">{{ number_format($rc->nilai_kerjasama * 0.1,2) }}</td>
            </tr>
            <tr>
                <td>4.</td><td>Motivasi (inisiatif dan kreatifitas)</td><td align="center">10</td><td align="center">{{ $rc->nilai_motivasi }}</td><td align="center">{{ number_format($rc->nilai_motivasi * 0.1,2) }}</td>
            </tr>
            <tr>
                <td>5.</td><td>Kepribadian (sikap, kematangan emosi, integritas)</td><td align="center">15</td><td align="center">{{ $rc->nilai_kepribadian }}</td><td align="center">{{ number_format($rc->nilai_kepribadian * 0.15,2) }}</td>
            </tr>
            <tr><th colspan="5" style="text-align:left;">Profesional</th></tr>
            <tr>
                <td>6.</td><td>Pengetahuan (penguasaan materi)</td><td align="center">15</td><td align="center">{{ $rc->nilai_pengetahuan }}</td><td align="center">{{ number_format($rc->nilai_pengetahuan * 0.15,2) }}</td>
            </tr>
            <tr>
                <td>7.</td><td>Pelaksanaan Kerja (ketelitian, sistematis, inisiatif)</td><td align="center">15</td><td align="center">{{ $rc->nilai_pelaksanaankerja }}</td><td align="center">{{ number_format($rc->nilai_pelaksanaankerja * 0.15,2) }}</td>
            </tr>
            <tr>
                <td>8.</td><td>Hasil Kerja (kualitas dan kuantitas hasil kerja)</td><td align="center">15</td><td align="center">{{ $rc->nilai_hasilkerja }}</td><td align="center">{{ number_format($rc->nilai_hasilkerja * 0.15,2) }}</td>
            </tr>
            <tr>
                <td colspan="4" align="right"><strong>Total Nilai</strong></td>
                <td align="center"><strong>{{ number_format($rc->nilai_akhir,2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="catatan">
        <p><strong>Catatan terkait 
            @if(optional($rc->permintaan->masterMgng->masterSklh)->jenis_sklh == 'pgt')
                mahasiswa
            @else
                siswa
            @endif
            {{ $rc->nama_peserta }} selama pelaksanaan magang:</strong></p>
        <p>{{ $rc->catatan ?? '-' }}</p>
    </div><br>

    <table class="signature" width="100%">
        <tr>
            <td style="width: 75%;"></td>
            <td align="center">
                Surabaya, {{ \Carbon\Carbon::parse($rc->tanggal_akhir_magang)->translatedFormat('d F Y') }}<br>
                Pembimbing Lapangan<br><br><br><br><br><br>
                <u><b>{{ $rc->bdngMember->nama_pejabat ?? '-' }}</b></u><br><br>
                {{ $rc->bdngMember->jabatan_pejabat ?? '-' }}<br>
                NIP: {{ $rc->bdngMember->nip_pejabat ?? '-' }}
            </td>
        </tr>
    </table><br>

    <p style="font-size: 10px; margin-top: 10px;">Catatan: Lembar penilaian ini mohon diserahkan kepada peserta dalam amplop tertutup dan tersegel.</p>

</body>
</html>
