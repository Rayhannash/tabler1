<x-app-layout pageTitle="Upload Laporan Magang">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-arrows breadcrumb-muted">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.daftar_laporanmagang') }}">Daftar Laporan Magang</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.showuploadlaporan', $permohonan) }}">Upload Laporan Magang</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Upload Laporan Magang</h3>
                </div>
                <div class="card-body">
                    @if($canUpload)
                        <form action="{{ route('user.uploadlaporan', ['id' => $permohonan->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Pilih File Laporan (max. 10MB)</label><br>
                                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><br>
                             <button type="submit" class="btn btn-primary text-white">
                                <span class="mdi mdi-send"> Kirim</span>
                            </button>
                        </form>
                    @else
                        <p class="text-muted">Kegiatan magang belum selesai, laporan tidak bisa diupload.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
