<x-app-layout pageTitle="Form Permohonan Magang">
    <x-page-header>
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <x-breadcrumb pageTitle="Buat Permohonan" />
            </div>
        </div>
    </x-page-header>

    <div class="page-body">
        <div class="container-xl">

            @if (session('result') == 'success')
                <div class="alert alert-success">Data berhasil disimpan!</div>
            @endif

            <form action="{{ route('user_extras.simpan_proposal') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">FORM PERMOHONAN MAGANG</h3>
                        <button type="submit" class="btn btn-primary text-white">
                            <span class="mdi mdi-send"> Kirim</span>
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-border mb-3">
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label class="iNomorSuratPermintaan">Nomor Surat</label>
                                            <input type="text" 
                                                name="nomor_surat_permintaan" 
                                                class="form-control {{ $errors->has('nomor_surat_permintaan') ? 'is-invalid' : '' }}" 
                                                value="{{ old('nomor_surat_permintaan') }}" 
                                                id="iNomorSuratPermintaan" 
                                                placeholder="Masukkan nomor surat disini">
                                        </div>

                                        <div class="mb-3">
                                            <label class="iTanggalSuratPermintaan">Tanggal Surat</label>
                                            <div class="input-icon">
                                                <span class="input-icon-addon">
                                                    <i class="mdi mdi-calendar-month cursor-pointer" id="calendarTrigger"></i>
                                                </span>
                                                <input type="text"
                                                    name="tanggal_surat_permintaan"
                                                    class="form-control {{ $errors->has('tanggal_surat_permintaan') ? 'is-invalid' : '' }}"
                                                    value="{{ old('tanggal_surat_permintaan') }}"
                                                    id="iTanggalSuratPermintaan"
                                                    placeholder="yyyy-mm-dd"
                                                    required>
                                            </div>
                                            @if($errors->has('tanggal_surat_permintaan'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('tanggal_surat_permintaan') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="iPerihalSuratPermintaan">Perihal</label>
                                            <input type="text" 
                                                name="perihal_surat_permintaan" 
                                                class="form-control {{ $errors->has('perihal_surat_permintaan') ? 'is-invalid' : '' }}" 
                                                value="{{ old('perihal_surat_permintaan') }}" 
                                                id="iPerihalSuratPermintaan" 
                                                placeholder="Masukkan perihal disini">
                                            @if($errors->has('perihal_surat_permintaan'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('perihal_surat_permintaan') }}</div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="iDitandatanganiOleh">Ditandatangani Oleh</label>
                                            <input type="text" 
                                                name="ditandatangani_oleh" 
                                                class="form-control {{ $errors->has('ditandatangani_oleh') ? 'is-invalid' : '' }}" 
                                                value="{{ old('ditandatangani_oleh') }}" 
                                                id="iDitandatanganiOleh" 
                                                placeholder="Catatan: diisi jabatan, bukan nama orangnya">
                                            @if($errors->has('ditandatangani_oleh'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('ditandatangani_oleh') }}</div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="iScanSuratPermintaan">Scan Surat Permintaan (.jpg, .pdf, max 10MB)</label>
                                            <input type="file" 
                                                name="scan_surat_permintaan" 
                                                class="form-control {{ $errors->has('scan_surat_permintaan') ? 'is-invalid' : '' }}" 
                                                id="iScanSuratPermintaan">
                                            @if($errors->has('scan_surat_permintaan'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('scan_surat_permintaan') }}</div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="iScanSuratProposalMagang">Scan Proposal Magang (.jpg, .pdf, max 10MB)</label>
                                            <input type="file" 
                                                name="scan_proposal_magang" 
                                                class="form-control {{ $errors->has('scan_proposal_magang') ? 'is-invalid' : '' }}" 
                                                id="iScanSuratProposalMagang">
                                            @if($errors->has('scan_proposal_magang'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('scan_proposal_magang') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> {{-- end row --}}
                    </div> {{-- end card-body --}}
                </div> {{-- end card --}}
            </form>
        </div>
    </div>

    {{-- Script Litepicker --}}
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const input = document.getElementById("iTanggalSuratPermintaan");
                const triggerIcon = document.getElementById("calendarTrigger");

                const picker = new Litepicker({
                    element: input,
                    format: "YYYY-MM-DD",
                    autoApply: true,
                });

                triggerIcon.addEventListener("click", () => {
                    picker.show();
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#datepicker-tanggal-surat').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });
            });
        </script>
    @endpush
</x-app-layout>
