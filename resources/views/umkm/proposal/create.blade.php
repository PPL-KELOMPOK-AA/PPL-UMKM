@extends('layouts.umkm')

@section('title', 'Unggah Proposal Proyek UMKM')
@section('navbar-title', 'Pengajuan Proposal')

@section('content')

<style>
    /* Styling form disesuaikan dengan desain dashboard pemerintah/platform */
    .form-section-title {
        color: var(--navy);
        font-family: 'Manrope', 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 700;
    }

    .form-label-custom {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .form-control-custom {
        padding: 12px 16px;
        border: 1px solid #dce4ed;
        border-radius: 10px;
        font-size: 13.5px;
        color: var(--text-dark);
        background-color: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3.5px rgba(93, 128, 179, 0.18);
        outline: none;
    }

    .input-addon-custom {
        background-color: var(--blue-soft);
        color: var(--navy);
        border: 1px solid #dce4ed;
        border-right: none;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        font-weight: 700;
        font-size: 13.5px;
        padding: 0 16px;
    }

    .input-group > .form-control-custom {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .upload-dropzone {
        border: 2px dashed #cad8ec;
        background: #fafbfd;
        border-radius: 14px;
        padding: 32px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .upload-dropzone:hover,
    .upload-dropzone.dragover {
        border-color: var(--blue);
        background: #f0f5fc;
    }

    .upload-icon-circle {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: var(--blue-soft);
        color: var(--blue);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 12px;
    }

    .format-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 6px;
        background: #eaf1fb;
        color: var(--navy);
        font-size: 11px;
        font-weight: 700;
    }

    .file-preview-card {
        display: none;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 10px;
        background: #eaf1fb;
        border: 1px solid #d7e4f7;
        margin-top: 14px;
    }

    .file-preview-left {
        display: flex;
        align-items: center;
        gap: 12px;
        overflow: hidden;
    }

    .file-preview-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #ffffff;
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .file-preview-info {
        min-width: 0;
    }

    .file-preview-name {
        font-weight: 600;
        font-size: 13px;
        color: var(--navy);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-preview-size {
        font-size: 11px;
        color: var(--text-muted);
    }

    .timeline-list {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .timeline-step {
        display: flex;
        align-items: stretch;
        gap: 14px;
        flex: 1;
    }

    .timeline-marker {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 32px;
        flex-shrink: 0;
    }

    .timeline-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--blue-soft);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
        z-index: 2;
    }

    .timeline-line {
        width: 2px;
        flex-grow: 1;
        background: #cbd8e8;
        margin-top: -1px;
        margin-bottom: -1px;
    }

    .timeline-content {
        padding-top: 4px;
        padding-bottom: 22px;
        flex-grow: 1;
    }

    .timeline-step:last-child .timeline-content {
        padding-bottom: 6px;
    }

    .timeline-content h4 {
        margin: 0 0 3px;
        font-size: 13px;
        font-weight: 600;
        color: var(--navy);
    }

    .timeline-content p {
        margin: 0;
        font-size: 11.5px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .currency-live-preview {
        font-size: 12px;
        font-weight: 600;
        color: #2b7a4b;
        margin-top: 6px;
        display: none;
    }
</style>

{{-- PAGE HEADING --}}
<div class="page-heading">
    <h1>Unggah Proposal Proyek UMKM</h1>
    <p>Ajukan proposal proyek bisnis dan inovasi usahamu untuk menarik minat investor serta membuka peluang pendanaan modal usaha.</p>
</div>

{{-- NOTIFIKASI FLASH SUKSES --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 14px; background: #e8f6ed; border: 1px solid #c2e7cf; color: #25663e;">
        <i class="bi bi-check-circle-fill fs-5 me-2"></i>
        <div class="fw-medium">{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- NOTIFIKASI FLASH ERROR --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start mb-4" role="alert" style="border-radius: 14px; background: #fde8e8; border: 1px solid #f8b4b4; color: #9b1c1c;">
        <i class="bi bi-exclamation-triangle-fill fs-5 me-2 mt-1"></i>
        <div class="w-100">
            <strong class="d-block mb-1">Pengajuan proposal belum berhasil diproses:</strong>
            <ul class="mb-0 ps-3" style="font-size: 13px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4 align-items-stretch">

    {{-- KOLOM UTAMA: FORMULIR PROPOSAL --}}
    <div class="col-lg-8 d-flex flex-column">
        <div class="dashboard-card p-4 p-md-5 flex-fill d-flex flex-column justify-content-between">

            <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                <div>
                    <h2 class="form-section-title mb-1">
                        <i class="bi bi-file-earmark-text text-primary me-2"></i>Formulir Rincian Proposal
                    </h2>
                    <p class="text-muted small mb-0">Isi data inovasi dan estimasi kebutuhan pendanaan untuk proyek usahamu.</p>
                </div>
                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 11px;">
                    <span class="text-danger">*</span> Wajib diisi
                </span>
            </div>

            <form action="{{ route('umkm.proposal.ajukan') }}" method="POST" enctype="multipart/form-data" id="proposalForm" class="d-flex flex-column justify-content-between flex-grow-1">
                @csrf

                {{-- 1. JUDUL PROYEK --}}
                <div class="mb-4">
                    <label for="judul" class="form-label-custom d-flex justify-content-between align-items-center">
                        <span>Judul Proyek Inovasi <span class="text-danger">*</span></span>
                    </label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control form-control-custom @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Digitalisasi Rantai Pasok Kopi Arabika Berbasis IoT"
                        maxlength="255"
                        required>
                    @error('judul')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @else
                        <div class="form-text text-muted" style="font-size: 12px;">
                            Berikan nama proyek inovasi yang memikat, jelas, dan menggambarkan solusi usahamu.
                        </div>
                    @enderror
                </div>

                {{-- 2. TARGET DANA DIBUTUHKAN --}}
                <div class="mb-4">
                    <label for="dana_dibutuhkan" class="form-label-custom">
                        Target Dana Dibutuhkan <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text input-addon-custom">Rp</span>
                        <input
                            type="number"
                            name="dana_dibutuhkan"
                            id="dana_dibutuhkan"
                            class="form-control form-control-custom @error('dana_dibutuhkan') is-invalid @enderror"
                            value="{{ old('dana_dibutuhkan') }}"
                            min="1000"
                            step="1"
                            placeholder="Contoh: 50000000"
                            required>
                    </div>
                    <div id="currencyPreview" class="currency-live-preview">
                        <i class="bi bi-tag-fill me-1"></i> Terbilang: <span id="currencyText">Rp0</span>
                    </div>
                    @error('dana_dibutuhkan')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @else
                        <div class="form-text text-muted" style="font-size: 12px;">
                            Estimasi jumlah modal kerja atau investasi yang kamu butuhkan dari investor (minimal Rp1.000).
                        </div>
                    @enderror
                </div>

                {{-- 3. DESKRIPSI INOVASI --}}
                <div class="mb-4">
                    <label for="deskripsi_inovasi" class="form-label-custom">
                        Deskripsi Inovasi & Nilai Tambah Usaha <span class="text-danger">*</span>
                    </label>
                    <textarea
                        name="deskripsi_inovasi"
                        id="deskripsi_inovasi"
                        rows="5"
                        class="form-control form-control-custom @error('deskripsi_inovasi') is-invalid @enderror"
                        placeholder="Jelaskan latar belakang, permasalahan yang ingin diselesaikan, keunikan inovasimu dibanding kompetitor, target pasar potensial, serta bagaimana dana investasi akan kamu gunakan..."
                        required>{{ old('deskripsi_inovasi') }}</textarea>
                    @error('deskripsi_inovasi')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @else
                        <div class="form-text text-muted" style="font-size: 12px;">
                            Ceritakan keunggulan bisnismu secara komprehensif agar investor tertarik menanamkan modal.
                        </div>
                    @enderror
                </div>

                {{-- 4. DOKUMEN PROPOSAL --}}
                <div class="mb-4">
                    <label class="form-label-custom d-flex justify-content-between align-items-center">
                        <span>Dokumen Proposal Lengkap <span class="text-danger">*</span></span>
                        <div class="d-flex gap-1">
                            <span class="format-pill">PDF</span>
                            <span class="format-pill">DOCX</span>
                        </div>
                    </label>

                    {{-- Dropzone Area --}}
                    <div class="upload-dropzone" id="dropzoneArea" onclick="document.getElementById('file_proposal').click();">
                        <input
                            type="file"
                            name="file_proposal"
                            id="file_proposal"
                            class="d-none"
                            accept=".pdf,.docx"
                            required>

                        <div class="upload-icon-circle">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>

                        <div class="fw-semibold text-dark mb-1" style="font-size: 13.5px;">
                            Pilih berkas proposal atau seret dokumen ke sini
                        </div>
                        <p class="text-muted small mb-2">
                            Format berkas yang diterima: <strong>.pdf</strong> atau <strong>.docx</strong>
                        </p>
                        <span class="badge bg-light text-muted border px-2.5 py-1" style="font-size: 11px;">
                            Ukuran berkas maksimal 10 MB
                        </span>
                    </div>

                    {{-- Pesan Error Validasi Klien (Jika > 10MB atau Format Salah) --}}
                    <div id="fileClientError" class="alert alert-danger d-none align-items-center mt-3 mb-0" style="border-radius: 10px; font-size: 12.5px; padding: 11px 14px; background: #fff1f0; border: 1px solid #ffa39e; color: #cf1322;">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-6 flex-shrink-0"></i>
                        <span id="fileClientErrorMessage"></span>
                    </div>

                    {{-- Selected File Preview --}}
                    <div class="file-preview-card" id="filePreviewCard">
                        <div class="file-preview-left">
                            <div class="file-preview-icon" id="filePreviewIcon">
                                <i class="bi bi-file-earmark-pdf text-danger"></i>
                            </div>
                            <div class="file-preview-info">
                                <div class="file-preview-name" id="fileNamePreview">-</div>
                                <div class="file-preview-size" id="fileSizePreview">-</div>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm border-0"
                            id="removeFileBtn"
                            title="Hapus berkas"
                            style="border-radius: 8px;">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>

                    @error('file_proposal')
                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <a href="{{ route('umkm.dashboard') }}" class="btn-dashboard btn-dashboard-outline">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>

                    <button type="submit" class="btn-dashboard">
                        <i class="bi bi-send"></i> Ajukan Proposal
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- KOLOM KANAN: PANDUAN & KETENTUAN UNTUK UMKM --}}
    <div class="col-lg-4 d-flex flex-column gap-4">

        {{-- KARTU 1: KETENTUAN BERKAS --}}
        <div class="dashboard-card p-4 flex-fill d-flex flex-column">
            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                <div class="stat-icon" style="width: 38px; height: 38px; font-size: 18px;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <h3 class="form-section-title mb-0" style="font-size: 15px;">Ketentuan Proposal</h3>
                    <p class="text-muted small mb-0">Syarat & kriteria berkas inovasi</p>
                </div>
            </div>

            <ul class="list-unstyled mb-0 d-flex flex-column justify-content-around flex-grow-1 py-1" style="font-size: 12.5px; gap: 14px;">
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong class="text-dark d-block">Format Berkas</strong>
                        <span class="text-muted">Hanya berkas berekstensi .PDF atau .DOCX yang dapat diproses sistem.</span>
                    </div>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong class="text-dark d-block">Batas Ukuran Dokumen</strong>
                        <span class="text-muted">Ukuran berkas maksimal tidak melebihi 10 Megabyte (MB).</span>
                    </div>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong class="text-dark d-block">Rencana Anggaran (RAB)</strong>
                        <span class="text-muted">Sertakan rincian alokasi kebutuhan dana secara transparan dan rasional.</span>
                    </div>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <strong class="text-dark d-block">Orisinalitas Ide Usaha</strong>
                        <span class="text-muted">Inovasi merupakan karya orisinal usahamu dan bebas dari sengketa HKI.</span>
                    </div>
                </li>
            </ul>

            <div class="mt-auto pt-3 border-top text-muted" style="font-size: 11.5px;">
                <i class="bi bi-info-circle text-primary me-1"></i> Kelengkapan dokumen mempercepat validasi proposal.
            </div>
        </div>

        {{-- KARTU 2: ALUR TAHAPAN PENGAJUAN --}}
        <div class="dashboard-card p-4 flex-fill d-flex flex-column">
            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                <div class="stat-icon" style="width: 38px; height: 38px; font-size: 18px;">
                    <i class="bi bi-diagram-3"></i>
                </div>
                <div>
                    <h3 class="form-section-title mb-0" style="font-size: 15px;">Tahapan Setelah Pengajuan</h3>
                    <p class="text-muted small mb-0">Alur kurasi dan penerbitan proyek</p>
                </div>
            </div>

            <div class="timeline-list py-1">
                <div class="timeline-step">
                    <div class="timeline-marker">
                        <div class="timeline-badge">1</div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-content">
                        <h4>Proposal Terkirim</h4>
                        <p>Dokumen berhasil tersimpan di sistem MitraUMKM dan masuk dalam antrean review.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-marker">
                        <div class="timeline-badge">2</div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-content">
                        <h4>Peninjauan & Kurasi</h4>
                        <p>Tim verifikator memeriksa kelayakan administrasi dan substansi inovasi usahamu.</p>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-marker">
                        <div class="timeline-badge">3</div>
                    </div>
                    <div class="timeline-content">
                        <h4>Katalog Investor</h4>
                        <p>Proposal lolos kurasi akan ditampilkan kepada investor untuk mendapatkan penawaran pendanaan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-auto pt-3 border-top text-muted" style="font-size: 11.5px;">
                <i class="bi bi-clock-history text-primary me-1"></i> Estimasi proses verifikasi berkas: 2–3 hari kerja.
            </div>
        </div>

    </div>

</div>

{{-- SCRIPT INTERAKTIF DRAG & DROP SERTA FORMATTER RUPIAH --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('file_proposal');
        const dropzoneArea = document.getElementById('dropzoneArea');
        const filePreviewCard = document.getElementById('filePreviewCard');
        const fileNamePreview = document.getElementById('fileNamePreview');
        const fileSizePreview = document.getElementById('fileSizePreview');
        const filePreviewIcon = document.getElementById('filePreviewIcon');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const fileClientError = document.getElementById('fileClientError');
        const fileClientErrorMessage = document.getElementById('fileClientErrorMessage');

        const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10 MB (10.485.760 bytes)
        const ALLOWED_EXTENSIONS = ['pdf', 'docx'];

        function showFileError(msg) {
            if (fileClientError && fileClientErrorMessage) {
                fileClientErrorMessage.textContent = msg;
                fileClientError.classList.remove('d-none');
                fileClientError.classList.add('d-flex');
            }
            if (dropzoneArea) {
                dropzoneArea.style.borderColor = '#cf1322';
                dropzoneArea.style.backgroundColor = '#fff1f0';
            }
        }

        function hideFileError() {
            if (fileClientError) {
                fileClientError.classList.add('d-none');
                fileClientError.classList.remove('d-flex');
            }
            if (dropzoneArea) {
                dropzoneArea.style.borderColor = '';
                dropzoneArea.style.backgroundColor = '';
            }
        }

        function resetFileInput() {
            if (fileInput) {
                fileInput.value = '';
            }
            if (filePreviewCard) {
                filePreviewCard.style.display = 'none';
            }
        }

        // Validasi instan saat berkas dipilih atau di-drop
        function validateAndPreviewFile(file) {
            hideFileError();

            if (!file) {
                resetFileInput();
                return false;
            }

            const ext = file.name.split('.').pop().toLowerCase();

            // 1. Cek format ekstensi
            if (!ALLOWED_EXTENSIONS.includes(ext)) {
                resetFileInput();
                showFileError('Format berkas tidak didukung (.' + ext + '). Berkas ditolak! Harap pilih berkas dengan format .PDF atau .DOCX.');
                return false;
            }

            // 2. Cek batas ukuran maksimal 10 mb
            if (file.size > MAX_FILE_SIZE) {
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                resetFileInput();
                showFileError('Ukuran berkas melebihi batas maksimal 10 MB (' + sizeInMB + ' MB). Berkas ditolak dan tidak dapat dimasukkan ke form!');
                return false;
            }

            // Jika valid, tampilkan pratinjau berkas
            fileNamePreview.textContent = file.name;
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            fileSizePreview.textContent = `${sizeInMB} MB`;

            if (ext === 'pdf') {
                filePreviewIcon.innerHTML = '<i class="bi bi-file-earmark-pdf-fill text-danger"></i>';
            } else {
                filePreviewIcon.innerHTML = '<i class="bi bi-file-earmark-word-fill text-primary"></i>';
            }

            filePreviewCard.style.display = 'flex';
            return true;
        }

        // Format live Rupiah
        const danaInput = document.getElementById('dana_dibutuhkan');
        const currencyPreview = document.getElementById('currencyPreview');
        const currencyText = document.getElementById('currencyText');

        function formatRupiah(val) {
            if (!val || isNaN(val)) return 'Rp 0';
            return 'Rp' + Number(val).toLocaleString('id-ID');
        }

        function updateCurrencyPreview() {
            const val = danaInput.value;
            if (val && Number(val) > 0) {
                currencyText.textContent = formatRupiah(val);
                currencyPreview.style.display = 'block';
            } else {
                currencyPreview.style.display = 'none';
            }
        }

        if (danaInput) {
            danaInput.addEventListener('input', updateCurrencyPreview);
            updateCurrencyPreview();
        }

        if (fileInput) {
            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files.length > 0) {
                    const valid = validateAndPreviewFile(fileInput.files[0]);
                    if (!valid) {
                        fileInput.value = '';
                    }
                }
            });
        }

        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                resetFileInput();
                hideFileError();
            });
        }

        // Drag & drop handlers
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzoneArea.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropzoneArea.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzoneArea.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropzoneArea.classList.remove('dragover');
            }, false);
        });

        dropzoneArea.addEventListener('drop', function (e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length > 0) {
                const valid = validateAndPreviewFile(files[0]);
                if (valid) {
                    fileInput.files = files;
                } else {
                    resetFileInput();
                }
            }
        });

        // Pengamanan saat form disubmit
        const proposalForm = document.getElementById('proposalForm');
        if (proposalForm) {
            proposalForm.addEventListener('submit', function (e) {
                if (fileInput.files && fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    if (file.size > MAX_FILE_SIZE) {
                        e.preventDefault();
                        showFileError('Ukuran berkas melebihi batas 10 MB. Pengajuan ditolak!');
                        return false;
                    }
                }
            });
        }
    });
</script>

@endsection
