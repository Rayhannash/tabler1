<x-app-layout pageTitle="Daftar Penilai">
    <x-page-header>
        <x-breadcrumb pageTitle="Daftar Penilai" />
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <x-button-add action="{{ route('master_petugas') }}" label="Tambah Penilai" target="#PenilaiModal" />
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">
            @if(session('result') == 'success')
                <x-alert type="success" message="Data berhasil disimpan." />
            @endif

            <div class="card">
                <div class="card-header">
                    <form method="GET" action="{{ route('master_petugas') }}" class="ms-auto w-100 w-md-auto">
                        <div class="input-icon">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Pencarian">
                            <span class="input-icon-addon">
                                <x-icon name="search" />
                            </span>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-vcenter table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Pangkat</th>
                                <th>Golongan</th>
                                <th>Ruang</th>
                                <th>Jabatan</th>
                                <th>Bidang</th>
                                <th>Sub Bidang</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $dt)
                                <tr>
                                    <td>{{ $dt->nama_pejabat }}</td>
                                    <td>{{ $dt->nip_pejabat }}</td>
                                    <td>{{ $dt->pangkat_pejabat }}</td>
                                    <td>{{ $dt->golongan_pejabat }}</td>
                                    <td>{{ $dt->ruang_pejabat }}</td>
                                    <td>{{ $dt->jabatan_pejabat }}</td>
                                    <td>{{ $dt->nama_bidang }}</td>
                                    <td>{{ $dt->sub_bidang_pejabat }}</td>
                                    <td>
                                        <a href="{{ route('master_petugas.edit', ['id' => $dt->id]) }}" class="btn btn-sm btn-primary">
                                            <x-icon name="eye" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $data->appends(request()->only('keyword'))->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.penilai.modal')
</x-app-layout>
