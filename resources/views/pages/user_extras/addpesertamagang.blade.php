<x-app-layout pageTitle="Tambah Peserta">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <ol class="breadcrumb breadcrumb-arrows breadcrumb-muted">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Daftar Permohonan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Tambah Peserta</a>
                    </li>
                </ol>
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

            @if(Auth::user()->akun_diverifikasi=='sudah')
                @if($permohonan->status_surat_permintaan == 'belum')
                    <form action="{{ route('user.simpan-peserta-magang', ['id' => $permohonan->id]) }}" role="form" enctype="multipart/form-data"  method="POST">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Tambah Peserta</h3>
                                <button type="submit" class="btn btn-primary text-white">
                                    <span class="mdi mdi-save"> Simpan</span>
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-border mb-3">
                                            <div class="card-body">

                                                <div class="mb-3">
                                                    <label for="iNamaPeserta">Nama Peserta</label>
                                                    <input type="text" 
                                                        name="nama_peserta" 
                                                        class="form-control {{ $errors->has('nama_peserta') ? 'is-invalid' : '' }}" 
                                                        value="{{ old('nama_peserta') }}" 
                                                        id="iNamaPeserta" 
                                                        placeholder="contoh : Hyuuga Uzuki" 
                                                        required>
                                                    @if($errors->has('nama_peserta'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('nama_peserta') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iJenisKelamin">Jenis Kelamin</label>
                                                    <select class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" 
                                                            id="iJenisKelamin" name="jenis_kelamin" required>
                                                        <option value="pria" {{ old('jenis_kelamin') == 'pria' ? 'selected' : '' }}>Pria</option>
                                                        <option value="wanita" {{ old('jenis_kelamin') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                                    </select>
                                                    @if($errors->has('jenis_kelamin'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('jenis_kelamin') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iNikPeserta">NIK Peserta</label>
                                                    <input type="number" 
                                                           name="nik_peserta" 
                                                           class="form-control {{ $errors->has('nik_peserta') ? 'is-invalid' : '' }}" 
                                                           value="{{ old('nik_peserta') }}" 
                                                           id="iNikPeserta" 
                                                           placeholder="contoh : 0123456789123456" 
                                                           required>
                                                    @if($errors->has('nik_peserta'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('nik_peserta') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iNisPeserta">NIS/NIM Peserta</label>
                                                    <input type="text" 
                                                           name="nis_peserta" 
                                                           class="form-control {{ $errors->has('nis_peserta') ? 'is-invalid' : '' }}" 
                                                           value="{{ old('nis_peserta') }}" 
                                                           id="iNisPeserta" 
                                                           placeholder="contoh : 1234567891" 
                                                           required>
                                                    @if($errors->has('nis_peserta'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('nis_peserta') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iProgramStudi">Program Studi</label>
                                                    <input type="text" 
                                                           name="program_studi" 
                                                           class="form-control {{ $errors->has('program_studi') ? 'is-invalid' : '' }}" 
                                                           value="{{ old('program_studi') }}" 
                                                           id="iProgramStudi" 
                                                           placeholder="contoh : Teknik Mesin" 
                                                           required>
                                                    @if($errors->has('program_studi'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('program_studi') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iNomorHandphone">Nomor Handphone</label>
                                                    <input type="number" 
                                                           name="no_handphone_peserta" 
                                                           class="form-control {{ $errors->has('no_handphone_peserta') ? 'is-invalid' : '' }}" 
                                                           value="{{ old('no_handphone_peserta') }}" 
                                                           id="iNomorHandphone" 
                                                           placeholder="contoh : 0812345678910" 
                                                           required>
                                                    @if($errors->has('no_handphone_peserta'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('no_handphone_peserta') }}</div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="iEmailPeserta">Email Peserta</label>
                                                    <input type="email" 
                                                           name="email_peserta" 
                                                           class="form-control {{ $errors->has('email_peserta') ? 'is-invalid' : '' }}" 
                                                           value="{{ old('email_peserta') }}" 
                                                           id="iEmailPeserta" 
                                                           placeholder="contoh : peserta@email.com" 
                                                           required>
                                                    @if($errors->has('email_peserta'))
                                                        <div class="invalid-feedback d-block">{{ $errors->first('email_peserta') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- end row --}}
                            </div> {{-- end card-body --}}
                        </div> {{-- end card --}}
                    </form>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-danger mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Akses Ditolak!</h3>
                                </div>
                                <div class="card-body">
                                    Tidak dapat menambahkan peserta ke permohonan yang sudah terkirim. Tekan tombol kembali untuk kembali ke halaman sebelumnya.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>