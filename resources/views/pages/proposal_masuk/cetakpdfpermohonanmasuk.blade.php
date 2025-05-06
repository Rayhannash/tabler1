<x-app-layout pageTitle="Cetak Permohonan Magang">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-arrows breadcrumb-muted">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.daftar_permohonan') }}">Daftar Permohonan</a>
                        </li>
                        <li class="breadcrumb-item muted" aria-current="page">
                            Cetak Permohonan Magang
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            <table width="100%">
                <tr height="15px">
                    <td></td><td width="1%"></td><td></td><td width="18%"></td><td></td>
                </tr>
                <tr>
                    <td width="10%"></td><td width="1%"></td><td width="39%"></td><td colspan="2" width="50%">
                        Surabaya, {{ Carbon\Carbon::parse($rc->tanggal_surat_balasan)->format('d F Y') }}
                    </td>
                </tr>
                <tr height="5px">
                    <td></td><td width="1%"></td><td></td><td width="18%"></td><td></td>
                </tr>
                <tr>
                    <td></td><td width="1%"></td><td></td><td rowspan="5">Kepada Yth. Sdr.</td><td rowspan="5">
                        {{$rc->ditandatangani_oleh}} {{$rc->name}}<br>di<br>&nbsp&nbsp&nbsp<b><u>TEMPAT</u></b>
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td><td width="1%">:</td><td>400.14.5.4/{{$rc->nomor_surat_balasan}}/114.1/{{Carbon\Carbon::parse($rc->tanggal_surat_balasan)->format('Y')}}</td>
                </tr>
                <tr>
                    <td>Sifat</td><td width="1%">:</td><td>
                        @if($rc->sifat_surat_balasan=='biasa') Biasa @elseif($rc->sifat_surat_balasan=='penting') Penting @elseif($rc->sifat_surat_balasan=='segera') Segera @endif
                    </td>
                </tr>
                <tr>
                    <td>Lampiran</td><td width="1%">:</td><td>
                        @if($rc->lampiran_surat_balasan=='tidakada') - @else 1 (satu) berkas @endif
                    </td>
                </tr>
                <tr>
                    <td>Perihal</td><td width="1%">:</td><td>Permohonan Magang</td>
                </tr>
                <tr height="36px"></tr>
                <tr>
                    <td></td><td></td><td colspan="3">
                        <p style="text-indent: 2em">
                            Sehubungan dengan surat Saudara tanggal {{ Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }} nomor {{$rc->nomor_surat_permintaan}}, perihal {{$rc->perihal_surat_permintaan}}, bersama ini disampaikan bahwa Dinas Komunikasi dan Informatika Provinsi Jawa Timur menerima Permohonan Magang @if($rc->jenis_sklh!='ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif {{$rc->name}}@if($rc->metode_magang=='online') secara Daring/<i>Online</i> @endif atas nama:
                        </p>
                        <table border="1px" class="css-serial" cellspacing="0" width="100%">
                            <tr>
                                <th>NO</th>
                                <th>Nama Peserta</th>
                                <th>@if($rc->jenis_sklh!='ptg') NIS @else NIM @endif</th>
                                <th>Program Studi</th>
                            </tr>
                            @foreach($rd as $dt)
                            @if($dt->master_magang_id == $rc->id)
                            <tr>
                                <td align="center"></td>
                                <td>&nbsp{{$dt->nama_peserta}}</td>
                                <td align="center">{{$dt->nis_peserta}}</td>
                                <td align="center">{{$dt->program_studi}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                        <p>Pelaksanaan magang diatur dalam ketentuan sebagai berikut :</p>
                        <table cellspacing="0" width="100%">
                            <tr><td>1. </td><td>Jadwal Magang dimulai tanggal {{ Carbon\Carbon::parse($rc->tanggal_awal_magang)->format('d F Y') }} s.d. {{ Carbon\Carbon::parse($rc->tanggal_akhir_magang)->format('d F Y') }};</td></tr>
                            <tr><td>2. </td><td>Jam Kerja Magang dimulai pukul 08.00 s.d. 14.00 WIB;</td></tr>
                            <tr><td>3. </td><td>{{$rc->name}} mengupload Laporan @if($rc->jenis_sklh!='ptg') Siswa/Siswi @else Mahasiswa/Mahasiswi @endif Magang melalui Aplikasi sima.jatimprov.go.id.</td></tr>
                        </table>
                        <p style="text-indent: 2em">Demikian atas perhatian dan kerjasamanya disampaikan terima kasih.</p>
                    </td>
                </tr>
            </table>

            <table cellspacing="0" width="100%">
                <tr height="100px">
                    <td width="40%"></td><td align="center" width="60%"></td>
                </tr>
                <tr>
                    <td width="40%"></td><td align="center" width="60%">
                        a.n. KEPALA DINAS KOMUNIKASI DAN INFORMATIKA<br>PROVINSI JAWA TIMUR<br>
                    </td>
                </tr>
                <tr height="5px">
                    <td width="40%"></td><td align="center" width="60%"></td>
                </tr>
                <tr>
                    <td width="40%"></td><td align="center" width="60%">Sekretaris</td>
                </tr>
                <tr height="100px">
                    <td width="40%"></td><td align="center" width="60%"></td>
                </tr>
                <tr>
                    <td width="40%"></td><td align="center" width="60%"><b><u>{{$rc->nama_pejabat}}</u></b><br>{{$rc->pangkat_pejabat}}</td>
                </tr>
                <tr>
                    <td width="40%"></td><td align="center" width="60%">NIP. {{$rc->nip_pejabat}}</td>
                </tr>
            </table>
        </div>
    </div>
</x-app-layout>
