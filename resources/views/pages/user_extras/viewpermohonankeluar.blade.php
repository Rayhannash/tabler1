<x-app-layout pageTitle="Detail Permohonan">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Detail Permohonan"></x-breadcrumb>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">

            {{-- Notifikasi jika ada --}}
            @if (session('result') == 'update')
                <div class="alert alert-success">
                    Data berhasil diperbaharui.
                </div>
            @endif

            @if (session('result') == 'fail-delete')
                <div class="alert alert-danger">
                    Data gagal dihapus.
                </div>
            @endif

            @if(Auth::user()->privilege=='operator' && Auth::user()->akun_diverifikasi=='sudah')
            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('user.viewpermohonankeluar', ['id' => $rc->id]) }}">
                @csrf

                <!--start toolbar-->
                @if($rc->status_surat_permintaan == 'belum')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-sm btn-success" href="{{ route('user.editpermohonankeluar', ['id' => $rc->id]) }}">
                                    <i class="fa fa-fw fa-pencil-square-o"></i> Edit
                                </a>
                                @if(\App\MasterPsrt::where('id_mgng', $rc->id)->count() > 0)
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-fw fa-send"></i> Kirim
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!--end toolbar-->

                <!-- Box Content -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Mohon Diperhatikan!</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>Pihak lembaga pendidikan wajib menambahkan peserta terlebih dahulu sebelum bisa mengirim permohonan.</li>
                                    <li>Pastikan data yang Anda kirimkan benar, karena data yang terkirim tidak bisa diedit lagi.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Dasar -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">Informasi Dasar</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Nomor Surat Permintaan</td>
                                        <td>{{ $rc->nomor_surat_permintaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Surat Permintaan</td>
                                        <td>{{ \Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Perihal Surat Permintaan</td>
                                        <td>{{ $rc->perihal_surat_permintaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ditandatangani Oleh</td>
                                        <td>{{ $rc->ditandatangani_oleh }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- File Pendukung -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header with-border">
                                <h3 class="card-title">File Pendukung</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>File Scan Surat Permintaan</td>
                                        <td><a href="{{ url('storage/scan_surat_permintaan/'.$rc->scan_surat_permintaan) }}" target="_blank">{{ $rc->scan_surat_permintaan }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>File Scan Proposal Magang</td>
                                        <td><a href="{{ url('storage/scan_proposal_magang/'.$rc->scan_proposal_magang) }}" target="_blank">{{ $rc->scan_proposal_magang }}</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Daftar Peserta -->
                    <div class="col-md-6">
                        <div class="card">
                            @if($rc->status_surat_permintaan == 'belum')
                            <div class="card-header">
                                <a href="{{ route('user.addpesertamagang', ['id' => $rc->id]) }}" class="btn btn-success">
                                    <i class="fa fa-fw fa-plus"></i> Buat Data Peserta Baru
                                </a>
                            </div>
                            @endif

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center">DAFTAR PESERTA</th>
                                        </tr>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>NIS/NIM</th>
                                            <th>Program Studi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rd as $dt)
                                        @if($dt->id_mgng == $rc->id)
                                        <tr>
                                            <td>{{ $dt->nama_peserta }}</td>
                                            <td>{{ $dt->nis_peserta }}</td>
                                            <td>{{ $dt->program_studi }}</td>
                                            <td>
                                                <a href="{{ route('user.editpesertamagang', ['id' => $dt->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-fw fa-eye"></i> Lihat
                                                </a>
                                                @if($rc->status_surat_permintaan == 'belum')
                                                <button type="button" class="btn btn-sm btn-danger btn-trash" data-id="{{ $dt->id }}">
                                                    <i class="fa fa-fw fa-trash"></i> Hapus
                                                </button>
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

            </form>
            @else
            <div class="alert alert-danger">
                Akses Ditolak! Anda tidak diizinkan untuk mengakses halaman ini.
            </div>
            @endif
        </div>
    </div>
</x-app-layout>