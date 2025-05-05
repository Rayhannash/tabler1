<x-app-layout pageTitle="Permohonan Magang">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Permohonan Magang" />
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="{{ route('proposal_masuk') }}" class="d-flex">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control me-2" placeholder="Pencarian">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </form>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2">LEMBAGA PENDIDIKAN</th>
                                <th rowspan="2">DATA SURAT PERMOHONAN</th>
                                <th colspan="4" class="text-center">PESERTA</th>
                                <th rowspan="2" class="text-center">OPSI</th>
                            </tr>
                            <tr>
                                <th class="text-center">NIS/NIM</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center">PROGRAM STUDI</th>
                                <th class="text-center">OPSI PESERTA</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt)
                            {{-- Filter: Menampilkan hanya yang status_surat_permintaan = "terkirim" dan status_surat_balasan = "belum" --}}
                            @if($dt->status_surat_permintaan == 'terkirim')
                                <tr>
                                    <td>
                                        {{-- Data Lembaga Pendidikan --}}
                                        <b>Lembaga Pendidikan</b><br><br>
                                        <span class="mdi mdi-bank"></span> {{ $dt->masterMgng->masterSklh->user->fullname ?? 'Tidak Diketahui' }}<br>
                                        <span class="mdi mdi-map-marker"></span> {{ $dt->masterMgng->masterSklh->kabko_sklh ?? 'Provinsi Lainnya' }}
                                        <br><br>
                                        {{-- Data Narahubung --}}
                                        <b>Narahubung</b><br><br>
                                        <span class="mdi mdi-account"></span> {{ $dt->masterMgng->masterSklh->nama_narahubung ?? 'Tidak Diketahui' }}<br>
                                        <span class="mdi mdi-gender-male-female"></span> {{ ucfirst($dt->masterMgng->masterSklh->jenis_kelamin_narahubung ?? 'Tidak Diketahui') }}<br>
                                        <span class="mdi mdi-briefcase-variant"></span> {{ $dt->masterMgng->masterSklh->jabatan_narahubung ?? 'Tidak Diketahui' }}<br>
                                        <span class="mdi mdi-phone"></span> {{ $dt->masterMgng->masterSklh->handphone_narahubung ?? 'Tidak Diketahui' }}
                                    </td>
                                    <td>
                                        {{-- Data Surat Permohonan --}}
                                        <table>
                                            <span class="mdi mdi-sort-numeric-ascending"></span> {{ $dt->nomor_surat_permintaan }}<br>
                                            <span class="mdi mdi-calendar-month"></span> {{ \Carbon\Carbon::parse($dt->tanggal_surat_permintaan)->translatedFormat('d F Y') }}<br>
                                            <span class="mdi mdi-email"></span> <a href="{{ asset('storage/scan_surat_permintaan/'.$dt->scan_surat_permintaan) }}" target="_blank"> Surat Permohonan</a><br>
                                            <span class="mdi mdi-file"></span> <a href="{{ asset('storage/scan_proposal_magang/'.$dt->scan_proposal_magang) }}" target="_blank"> Proposal Magang</a><br>
                                        </table>
                                    </td>
                                    <td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id)
            {{ $de->nis_peserta }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id)
            {{ $de->nama_peserta }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id)
            {{ $de->program_studi }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
                                            @foreach($data2 as $de)
                                                @if($de->permintaan_mgng_id == $dt->id)
                                                    <a href="{{ route('masterpsrt.view', ['id' => $de->id]) }}">Lihat data peserta</a><br>
                                                @endif
                                            @endforeach
                                        </td>

                                        <td style="text-align: center">
                                            <a href="{{ route('proposal_masuk.balaspermohonan', ['id' => $dt->id]) }}" class="btn btn-success btn-sm"><span class="mdi mdi-reply"></span></a>
                                            <button type="button" class="btn btn-sm btn-danger btn-trash" data-id="{{$dt->id}}"><span class="mdi mdi-delete"></span></i></button>
                                        </td>
                                </tr>
                            @endif
                        @endforeach
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">Data permohonan magang tidak ditemukan.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
