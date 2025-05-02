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
            @if(Auth::user()->privilege != 'operator')
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
                                        <b>Lembaga Pendidikan</b><br>
                                        <small>
                                        <i class="fa fa-university"></i> {{ $dt->masterMgng->masterSklh->user->fullname ?? 'Tidak Diketahui' }}<br>
                                        <i class="fa fa-map"></i> {{ $dt->masterMgng->masterSklh->kabko_sklh ?? 'Provinsi Lainnya' }}
                                        </small>
                                        <hr>
                                        {{-- Data Narahubung --}}
                                        <b>Narahubung</b><br>
                                        <small>
                                        <i class="fa fa-user"></i> {{ $dt->masterMgng->masterSklh->nama_narahubung ?? 'Tidak Diketahui' }}<br>
                                        <i class="fa fa-venus-mars"></i> {{ ucfirst($dt->masterMgng->masterSklh->jenis_kelamin_narahubung ?? 'Tidak Diketahui') }}<br>
                                        <i class="fa fa-briefcase"></i> {{ $dt->masterMgng->masterSklh->jabatan_narahubung ?? 'Tidak Diketahui' }}<br>
                                        <i class="fa fa-phone"></i> {{ $dt->masterMgng->masterSklh->handphone_narahubung ?? 'Tidak Diketahui' }}
                                        </small>
                                    </td>
                                    <td>
                                        {{-- Data Surat Permohonan --}}
                                        <table>
                                            <tr>
                                                <td><i class="fa fa-file-text"></i></td>
                                                <td width="5pt"></td>
                                                <td>{{ $dt->surat_permohonan ?? 'Belum Ada' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>{{ $dt->nis_nim }}</td>
                                    <td>{{ $dt->nama_peserta }}</td>
                                    <td>{{ $dt->program_studi }}</td>
                                    <td>{{ $dt->opsi_peserta }}</td>
                                    <td>
                                        {{-- OPSI Actions (misalnya verifikasi atau suspend) --}}
                                        <button type="button" class="btn btn-sm btn-success">
                                            <span class="mdi mdi-check-bold"></span> Verifikasi
                                        </button>
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
            @endif
        </div>
    </div>
</x-app-layout>
