<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Penilaian - {{ $rc->nama_peserta }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; }
        th { background-color: #f0f0f0; }
        .no-border { border: none; }
    </style>
</head>
<body>
    <h2>Penilaian Peserta Magang</h2>
    <table class="no-border" width="100%">
        <tr><td>Nama</td><td>{{ $rc->nama_peserta }}</td></tr>
        <tr><td>@if($rc->jenis_sklh != 'ptg') NIS @else NIM @endif</td><td>{{ $rc->nis_peserta }}</td></tr>
        <tr><td>Lokasi Magang</td><td>Dinas Komunikasi dan Informatika Jawa Timur</td></tr>
        <tr><td>Unit/Bagian</td><td>{{ ($rc->notaDinas->masterBdng)->nama_bidang ?? 'Belum ditempatkan' }}</td></tr>
        <tr><td>Periode Magang</td><td>{{ \Carbon\Carbon::parse(optional($rc->permintaan->balasan)->tanggal_awal_magang ?? now())->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse(optional($rc->permintaan->balasan)->tanggal_akhir_magang ?? now())->translatedFormat('d F Y') }}</td></tr>
    </table>
    <br>

    <table>
        <thead>
            <tr>
                <th colspan="2">Aspek yang dinilai</th>
                <th>Bobot (%)</th>
                <th>Skor (40-100)</th>
                <th>Nilai (Bobot x Skor)</th>
            </tr>
        </thead>
        <tbody>
            <tr><th colspan="5">Personal</th></tr>
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
            <tr><th colspan="5">Profesional</th></tr>
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

    <br><br>
    <div style="border: 1px solid black; padding: 10px; max-width: 1000px;">
        <p><strong>Catatan terkait 
            @if(optional($rc->permintaan->masterMgng->masterSklh)->jenis_sklh == 'pgt')
                mahasiswa
            @else
                siswa
            @endif
            {{ $rc->nama_peserta }} selama pelaksanaan magang:</strong></p>
        <p>{{ $rc->catatan ?? '-' }}</p>
    </div>
    <br><br>
    <table width="100%" style="border:none;">
        <tr>
            <td width="120%" style="border:none;"></td>
            <td width="50%" align="center" style="border:none;">
                Surabaya, {{ \Carbon\Carbon::parse($rc->tanggal_akhir_magang)->translatedFormat('d F Y') }}<br>
                Pembimbing Lapangan<br><br><br><br><br>
                <u><b>{{ $rc->bdngMember->nama_pejabat ?? '-' }}</b></u><br>
                {{ $rc->bdngMember->jabatan_pejabat ?? '-' }}
            </td>
        </tr>
    </table>


    <p style="font-size: 10px;">Catatan: Lembar penilaian ini mohon diserahkan kepada peserta dalam amplop tertutup dan tersegel.</p>
</body>
</html>
