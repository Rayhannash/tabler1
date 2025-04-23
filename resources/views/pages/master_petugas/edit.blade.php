<x-app-layout pageTitle="Edit Data Penilai">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Edit Data Penilai" />
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-header mb-3">
                <h1 class="card-title h1">EDIT DATA PENILAI</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master_petugas.update', $petugas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Pejabat</label>
                            <input type="text" name="nama_pejabat" class="form-control" value="{{ old('nama_pejabat', $petugas->nama_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip_pejabat" class="form-control" value="{{ old('nip_pejabat', $petugas->nip_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pangkat</label>
                            <input type="text" name="pangkat_pejabat" class="form-control" value="{{ old('pangkat_pejabat', $petugas->pangkat_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Golongan</label>
                            <input type="text" name="golongan_pejabat" class="form-control" value="{{ old('golongan_pejabat', $petugas->golongan_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruang</label>
                            <input type="text" name="ruang_pejabat" class="form-control" value="{{ old('ruang_pejabat', $petugas->ruang_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan_pejabat" class="form-control" value="{{ old('jabatan_pejabat', $petugas->jabatan_pejabat) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Bidang</label>
                            <input type="text" name="sub_bidang_pejabat" class="form-control" value="{{ old('sub_bidang_pejabat', $petugas->sub_bidang_pejabat) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bidang</label>
                            <select name="id_bdng" class="form-select" required>
                                <option value="">-- Pilih Bidang --</option>
                                @foreach ($bidang as $b)
                                    <option value="{{ $b->id }}" {{ $petugas->id_bdng == $b->id ? 'selected' : '' }}>
                                        {{ $b->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('master_petugas') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
