<x-app-layout pageTitle="Daftar Permohonan">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Daftar Permohonan" />
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">

            {{-- Notifikasi jika ada --}}
            @if (session('result') == 'success')
                <div class="alert alert-success">
                    Data berhasil disimpan.
                </div>
            @endif

            <div class="card-header mb-3">
                <h1 class="card-title h1">DAFTAR PERMOHONAN</h1>
            </div>

            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">DATA SURAT PERMINTAAN</th> 
                                <th colspan="4" class="text-center">PESERTA</th> 
                                <th rowspan="2" class="text-center">STATUS</th> 
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
                            @forelse($permintaan as $dt)
                                @if($dt->masterMgng->masterSklh->id_user == Auth::user()->id && $dt->status_surat_permintaan == 'belum')
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li><span class="mdi mdi-sort-numeric-ascending"></span> {{ $dt->nomor_surat_permintaan }}</li>
                                                <li><span class="mdi mdi-calendar-month"></span> {{ \Carbon\Carbon::parse($dt->tanggal_surat_permintaan)->translatedFormat('d F Y') }}</li>
                                                <li><span class="mdi mdi-information-variant"></span> {{ $dt->perihal_surat_permintaan }}</li>
                                                <li><span class="mdi mdi-email"></span> <a href="{{ asset('storage/scan_surat_permintaan/'.$dt->scan_surat_permintaan) }}" target="_blank">Surat Permohonan</a></li>
                                                <li><span class="mdi mdi-file"></span> <a href="{{ asset('storage/scan_proposal_magang/'.$dt->scan_proposal_magang) }}" target="_blank">Proposal Magang</a></li>
                                            </ul>
                                        </td>

                                        <!-- Kolom PESERTA -->
                                        <td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id) <!-- Ganti dari id_mgng ke permintaan_mgng_id -->
            {{ $de->nis_peserta }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id) <!-- Ganti dari id_mgng ke permintaan_mgng_id -->
            {{ $de->nama_peserta }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id) <!-- Ganti dari id_mgng ke permintaan_mgng_id -->
            {{ $de->program_studi }}<br>
        @endif
    @endforeach
</td>

<td class="text-center">
    @foreach($data2 as $de)
        @if($de->permintaan_mgng_id == $dt->id) <!-- Ganti dari id_mgng ke permintaan_mgng_id -->
            <a href="#">
                {{ $dt->status_surat_permintaan == 'belum' ? 'Edit Peserta' : 'Lihat Peserta' }}
            </a><br>
        @endif
    @endforeach
</td>


                                        <!-- Kolom STATUS -->
                                        <td class="text-center">
                                            @if($dt->status_surat_permintaan == 'belum')
                                                Belum Terkirim
                                            @else
                                                Menunggu Persetujuan
                                            @endif
                                        </td>

                                        <!-- Kolom OPSI -->
                                        <td class="text-center">
                                        <a href="{{ route('user.viewpermohonankeluar', ['id' => $dt->id]) }}" class="btn btn-primary btn-sm">
                                            <span class="mdi mdi-eye"></span>
                                        </a>
                                            
                                            @if($dt->status_surat_permintaan == 'belum')
    <a href="{{ route('user.addpesertamagang', ['id' => $dt->id]) }}" class="btn btn-success btn-sm">
        <span class="mdi mdi-account-plus"></span>
    </a>
@endif
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_{{ $dt->id }}">
                                                <span class="mdi mdi-delete"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Modal Hapus --}}
        <form action="{{ route('user.hapus_permohonan', ['id' => $dt->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="delete_{{ $dt->id }}" tabindex="-1" aria-labelledby="deleteLabel_{{ $dt->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteLabel_{{ $dt->id }}">Hapus Permohonan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus?
                            <input type="hidden" name="id" value="{{ $dt->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Data permohonan tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
