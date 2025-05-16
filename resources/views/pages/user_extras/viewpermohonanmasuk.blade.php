<x-app-layout pageTitle="Detail Permohonan">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <!-- Breadcrumb or other content here -->
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            @if(Auth::user()->akun_diverifikasi == 'sudah')
                @if(session('result') == 'update')
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Data berhasil diperbaharui
                    </div>
                @endif

                @if(session('result') == 'fail-delete')
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Data gagal dihapus
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">File</h5>
                            </div>
                            <div class="card-body">
                                <table style="font-size: 12pt; border-collapse: separate; border-spacing: 0 15px">
                                    <tr>
                                        <td>File Surat Permohonan</td><td width="20px" align="center">:</td>
                                        <td><a target="_blank" href="{{ asset('storage/scan_surat_permintaan/'.$rc->scan_surat_permintaan) }}">{{ $rc->scan_surat_permintaan }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>File Proposal Magang</td><td width="20px" align="center">:</td>
                                        <td><a target="_blank" href="{{ asset('storage/scan_proposal_magang/'.$rc->scan_proposal_magang) }}">{{ $rc->scan_proposal_magang }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>File Surat Balasan</td><td width="20px" align="center">:</td>
                                        <td>
                                            @if($rc->balasan)
                                                <a target="_blank" href="{{ asset('storage/scan_surat_balasan/'.$rc->balasan->scan_surat_balasan) }}">{{ $rc->balasan->scan_surat_balasan }}</a>
                                            @else
                                                Tidak ada balasan
                                            @endif
                                        </td>
                                    </tr>
                                    @if($rc->status_sertifikat == 'terkirim')
                                        <tr>
                                            <td>Link Sertifikat</td><td width="20px" align="center">:</td>
                                            <td><a target="_blank" href="{{ $rc->scan_sertifikat }}">{{ $rc->scan_sertifikat }}</a></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Daftar Peserta</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>NIS/NIM Peserta</th>
                                            <th>Program Studi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rd as $dt)
                                            @if($dt->permintaan_mgng_id == $rc->id)
                                                <tr>
                                                    <td>{{ $dt->nama_peserta }}</td>
                                                    <td>{{ $dt->nis_peserta }}</td>
                                                    <td>{{ $dt->program_studi }}</td>
                                                    <td>
                                                        <a href="{{ route('user.editpesertamagang', ['id' => $dt->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-eye"></i></a>
                                                        @if($dt->status_scan_penilaian == 'sudah')
                                                            <a href="{{ asset('storage/scan_penilaian/'.$dt->scan_penilaian) }}" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-fw fa-trophy"></i><i class="fa fa-fw fa-print"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    Anda tidak diizinkan untuk mengakses halaman ini!
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
