<x-app-layout pageTitle="Upload Penilaian">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-arrows breadcrumb-muted">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('proposal_final.daftar') }}">Laporan & Sertifikat</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('proposal_final.tanggapi', ['id' => $permohonan->id]) }}">Detail Laporan & Sertifikat</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('proposal_final.uploadpenilaian', ['id' => $rc->id]) }}">Upload Penilaian</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            @if(Auth::user()->role_id == 1)
                @if($rc->status_penilaian == 'sudah')
                    @if($rc->status_scan_penilaian == 'belum')
                        <form method="POST" enctype="multipart/form-data" action="{{ route('proposal_final.uploadpenilaian.simpan', ['id' => $rc->id]) }}">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3>Form Upload File Penilaian (Max 10MB)</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="file" name="scan_penilaian" class="form-control @error('scan_penilaian') is-invalid @enderror" required>
                                        @error('scan_penilaian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="mdi mdi-content-save"> Simpan</span>
                                    </button>
                                    <a href="{{ route('proposal_final.cetakpenilaian', ['id' => $rc->id]) }}" target="_blank" class="btn btn-warning">
                                        <i class="fa fa-print"></i> Cetak Penilaian
                                    </a>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            File penilaian sudah diupload.<br>
                            <a href="{{ route('proposal_final.cetakpenilaian', ['id' => $rc->id]) }}" target="_blank" class="btn btn-secondary">
                                <i class="fa fa-print"></i> Cetak Penilaian
                            </a>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning">
                        Peserta ini belum dinilai.<br>
                        <a href="{{ route('proposal_final.tanggapiproposal', ['id' => $rc->permintaan_mgng_id]) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                @endif
            @else
                <div class="alert alert-danger">
                    Anda tidak diizinkan membuka halaman ini.<br>
                    <a href="{{ route('proposal_final.daftar') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-arrow-left"></i> Kembali ke daftar
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
