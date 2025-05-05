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
                            <a href="{{ route('proposal_masuk') }}">Daftar Permohonan</a>
                        </li>
                        <li class="breadcrumb-item muted" aria-current="page">
                            Balas Permohonan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('proposal_masuk.tanggapiproposal', ['id' => $rc->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Dasar</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Nomor Surat Permintaan</td><td>{{ $rc->nomor_surat_permintaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Surat Permintaan</td><td>{{ \Carbon\Carbon::parse($rc->tanggal_surat_permintaan)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>File Scan Surat Permintaan</td><td><a href="{{ asset('storage/scan_surat_permintaan/'.$rc->scan_surat_permintaan) }}" target="_blank">Lihat Surat Permintaan</a></td>
                                    </tr>
                                    <tr>
                                        <td>File Scan Proposal Magang</td><td><a href="{{ asset('storage/scan_proposal_magang/'.$rc->scan_proposal_magang) }}" target="_blank">Lihat Proposal</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

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
                                    <label for="iNomorSuratBalasan">Nomor Surat Balasan</label>
                                    <input type="text" name="nomor_surat_balasan" id="iNomorSuratBalasan" class="form-control" value="{{ old('nomor_surat_balasan', $rc->nomor_surat_balasan) }}">
                                </div>

                                <div class="form-group">
                                    <label for="iTanggalSuratBalasan">Tanggal Surat</label>
                                    <input type="date" name="tanggal_surat_balasan" id="iTanggalSuratBalasan" class="form-control" value="{{ old('tanggal_surat_balasan', $rc->tanggal_surat_balasan) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="iSifatSuratBalasan">Sifat</label>
                                    <select name="sifat_surat_balasan" id="iSifatSuratBalasan" class="form-control">
                                        <option value="biasa" {{ old('sifat_surat_balasan', $rc->sifat_surat_balasan) == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                        <option value="penting" {{ old('sifat_surat_balasan', $rc->sifat_surat_balasan) == 'penting' ? 'selected' : '' }}>Penting</option>
                                        <option value="segera" {{ old('sifat_surat_balasan', $rc->sifat_surat_balasan) == 'segera' ? 'selected' : '' }}>Segera</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iMetodeMagang">Metode Magang</label>
                                    <select name="metode_magang" id="iMetodeMagang" class="form-control">
                                        <option value="offline" {{ old('metode_magang', $rc->metode_magang) == 'offline' ? 'selected' : '' }}>Offline</option>
                                        <option value="online" {{ old('metode_magang', $rc->metode_magang) == 'online' ? 'selected' : '' }}>Online</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iTanggalAwalMagang">Tanggal Awal Magang</label>
                                    <input type="date" name="tanggal_awal_magang" id="iTanggalAwalMagang" class="form-control" value="{{ old('tanggal_awal_magang', $rc->tanggal_awal_magang) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="iTanggalAkhirMagang">Tanggal Akhir Magang</label>
                                    <input type="date" name="tanggal_akhir_magang" id="iTanggalAkhirMagang" class="form-control" value="{{ old('tanggal_akhir_magang', $rc->tanggal_akhir_magang) }}" required>
                                </div>

                                <!-- Tombol Simpan -->
                                <button type="submit" class="btn btn-primary" id="submitButton">Kirim Balasan</button>

                                <!-- Tombol Cetak PDF (Tersembunyi sampai tombol Simpan ditekan) -->
                                <a href="{{ route('proposal_masuk.cetakpdfpermohonanmasuk', ['id' => $rc->id]) }}" class="btn btn-success" id="cetakPdfButton" style="display:none;" target="_blank">Cetak PDF</a>

                                <!-- Form Lampiran Surat Balasan (Tersembunyi sampai tombol Simpan ditekan) -->
                                <div id="lampiranSection" style="display:none;">
                                    <div class="form-group">
                                        <label for="iScanSuratBalasan">Lampiran Surat Balasan</label>
                                        <input type="file" name="scan_surat_balasan" id="iScanSuratBalasan" class="form-control" accept=".pdf,.jpg,.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk menampilkan tombol Cetak PDF dan form Lampiran setelah simpan -->
    <script>
        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah form untuk langsung disubmit
            document.getElementById('cetakPdfButton').style.display = 'inline-block'; // Menampilkan tombol Cetak PDF
            document.getElementById('lampiranSection').style.display = 'block'; // Menampilkan form lampiran

            // Submit form setelah tombol simpan ditekan
            setTimeout(function () {
                document.querySelector('form').submit();
            }, 1000); // Memberi waktu sejenak sebelum form disubmit
        });
    </script>
</x-app-layout>
