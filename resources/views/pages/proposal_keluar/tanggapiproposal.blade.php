<x-app-layout pageTitle="Balas Permohonan">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-arrows breadcrumb-muted">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('proposal_keluar') }}">Balasan Magang</a>
                        </li>
                        <li class="breadcrumb-item muted" aria-current="page">
                            Detail Balasan Magang
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('proposal_keluar.tanggapiproposal', ['id' => $rc->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Peserta</h3>
                            </div>
                            <div class="card-body table-responsive">
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
                                        @foreach($rd as $peserta)
                                            <tr>
                                                <td>{{ $peserta->nama_peserta }}</td>
                                                <td>{{ $peserta->nis_peserta }}</td>
                                                <td>{{ $peserta->program_studi }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('masterpsrt.view', ['id' => $peserta->id]) }}" class="btn btn-primary btn-sm">
                                                        <span class="mdi mdi-eye"></span> 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Form untuk Balas Permohonan -->
                                <div class="form-group">
                                    <label for="iNomorSuratBalasan"><strong>Nomor Surat Balasan</strong></label>
                                    <input type="text" name="nomor_surat_balasan" id="iNomorSuratBalasan" class="form-control" 
                                           value="{{ old('nomor_surat_balasan', $balasan->nomor_surat_balasan) }}">
                                </div><br>

                                <div class="form-group">
                                    <label for="iTanggalSuratBalasan"><strong>Tanggal Surat</strong></label>
                                    <input type="date" name="tanggal_surat_balasan" id="iTanggalSuratBalasan" class="form-control"
                                           value="{{ old('tanggal_surat_balasan', $balasan->tanggal_surat_balasan) }}" required>
                                </div><br>

                                <div class="form-group">
                                    <label for="iSifatSuratBalasan"><strong>Sifat</strong></label>
                                    <select name="sifat_surat_balasan" id="iSifatSuratBalasan" class="form-control">
                                        <option value="biasa" {{ old('sifat_surat_balasan', $balasan->sifat_surat_balasan) == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                        <option value="penting" {{ old('sifat_surat_balasan', $balasan->sifat_surat_balasan) == 'penting' ? 'selected' : '' }}>Penting</option>
                                        <option value="segera" {{ old('sifat_surat_balasan', $balasan->sifat_surat_balasan) == 'segera' ? 'selected' : '' }}>Segera</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="iMetodeMagang"><strong>Metode Magang</strong></label>
                                    <select name="metode_magang" id="iMetodeMagang" class="form-control">
                                        <option value="offline" {{ old('metode_magang', $balasan->metode_magang) == 'offline' ? 'selected' : '' }}>Offline</option>
                                        <option value="online" {{ old('metode_magang', $balasan->metode_magang) == 'online' ? 'selected' : '' }}>Online</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <label for="iLampiranSuratBalasan"><strong>Surat Balasan</strong></label>
                                    <select class="form-control" id="iLampiranSuratBalasan" name="lampiran_surat_balasan">
                                        <option value="tidakada" {{ old('lampiran_surat_balasan', $balasan->lampiran_surat_balasan) == 'tidakada' ? 'selected' : '' }}>-</option>
                                        <option value="selembar" {{ old('lampiran_surat_balasan', $balasan->lampiran_surat_balasan) == 'selembar' ? 'selected' : '' }}>1 (satu) berkas</option>
                                    </select>
                                </div><br>

                                <div class="form-group" id="lampiranSection">
                                    <label for="iScanSuratBalasan"><strong>Scan Surat Balasan</strong></label>
                                    @if($balasan->scan_surat_balasan)
                                        <p>File saat ini: 
                                            <a href="{{ asset('storage/scan_surat_balasan/'.$balasan->scan_surat_balasan) }}" target="_blank" class="text-primary">
                                                {{ $balasan->scan_surat_balasan }}
                                            </a>
                                        </p>
                                    @endif
                                    <input type="file" name="scan_surat_balasan" id="iScanSuratBalasan" class="form-control" accept=".pdf,.jpg,.png">
                                </div><br>

                                <div class="form-group">
                                    <label for="iTanggalAwalMagang"><strong>Tanggal Awal Magang</strong></label>
                                    <input type="date" name="tanggal_awal_magang" id="iTanggalAwalMagang" class="form-control" 
                                           value="{{ old('tanggal_awal_magang', $balasan->tanggal_awal_magang) }}" required>
                                </div><br>

                                <div class="form-group">
                                    <label for="iTanggalAkhirMagang"><strong>Tanggal Akhir Magang</strong></label>
                                    <input type="date" name="tanggal_akhir_magang" id="iTanggalAkhirMagang" class="form-control" 
                                           value="{{ old('tanggal_akhir_magang', $balasan->tanggal_akhir_magang) }}" required>
                                </div><br>

                                <!-- Tombol Simpan dan Cetak PDF -->
                                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                                <a href="{{ route('proposal_keluar.cetakpdfpermohonankeluar', ['id' => $rc->id]) }}" class="btn btn-success" id="cetakPdfButton" target="_blank">Cetak PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
