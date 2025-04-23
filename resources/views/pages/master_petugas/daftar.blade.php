<x-app-layout pageTitle="Daftar Penilai">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Daftar Penilai" />
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
                <h1 class="card-title h1">DAFTAR PENILAI</h1>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form method="GET" action="{{ route('master_petugas') }}" class="ms-auto" style="max-width: 300px;">
                        <div class="input-icon">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Search…">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                </svg>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Pangkat</th>
                                    <th>Golongan</th>
                                    <th>Ruang</th>
                                    <th>Jabatan</th>
                                    <th>Bidang</th>
                                    <th>Sub bidang</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $dt)
                                    <tr>
                                        <td>{{ $dt->nama_pejabat }}</td>
                                        <td>{{ $dt->nip_pejabat }}</td>
                                        <td>{{ $dt->pangkat_pejabat }}</td>
                                        <td>{{ $dt->golongan_pejabat }}</td>
                                        <td>{{ $dt->ruang_pejabat }}</td>
                                        <td>{{ $dt->jabatan_pejabat }}</td>
                                        <td>{{ $dt->bidang->nama_bidang ?? '-' }}</td>
                                        <td>{{ $dt->sub_bidang_pejabat ?? '-' }}</td>
                                        <td class="text-center">
                                        <a href="{{ route('master_petugas.edit', $dt->member_id) }}"
                                            class="btn btn-icon btn-sm"
                                            title="Lihat/Edit"
                                            style="background-color: #007bff; color: white; border-radius: 5px; padding: 8px 12px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icon-tabler-eye" style="color: white;">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6
                                                    c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Data penilai tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
