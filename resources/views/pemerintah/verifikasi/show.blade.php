@extends('layouts.pemerintah')

@section('title', 'Tinjau Profil Investor: ' . $investor->nama_investor)
@section('navbar-title', 'Tinjau Profil Investor')

@section('content')

{{-- PAGE HEADING & BACK BUTTON --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <a href="{{ route('pemerintah.verifikasi.investor.index') }}" class="btn btn-outline-secondary btn-sm mb-2" style="border-radius: 8px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Verifikasi
        </a>
        <h1 class="h3 fw-bold text-dark mb-1">{{ $investor->nama_investor }}</h1>
        <p class="text-muted small mb-0">Tinjau informasi profil lengkap dan putuskan status verifikasi investor ini.</p>
    </div>

    <div>
        @if($investor->status_verifikasi === 'Terverifikasi')
            <span class="status-badge fs-6 px-3 py-2">
                <i class="bi bi-shield-check me-1"></i> Terverifikasi
            </span>
        @elseif($investor->status_verifikasi === 'Ditolak')
            <span class="status-badge rejected fs-6 px-3 py-2">
                <i class="bi bi-shield-x me-1"></i> Ditolak
            </span>
        @else
            <span class="status-badge pending fs-6 px-3 py-2">
                <i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi
            </span>
        @endif
    </div>
</div>

{{-- ERROR MESSAGES --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    {{-- KOLOM KIRI: RINCIAN PROFIL INVESTOR --}}
    <div class="col-lg-7">
        <div class="dashboard-card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--navy);">
                <i class="bi bi-person-badge me-2 text-primary"></i>Informasi Profil Investor
            </h5>

            <table class="table table-borderless align-middle mb-0">
                <tbody>
                    <tr class="border-bottom">
                        <td class="text-muted py-3" style="width: 200px;">ID Investor</td>
                        <td class="fw-semibold py-3">#INV-{{ str_pad($investor->id_investor, 4, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Nama Investor / Lembaga</td>
                        <td class="fw-bold py-3 text-dark">{{ $investor->nama_investor }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Username Akun</td>
                        <td class="py-3">
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-at"></i>{{ $investor->username }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Jenis / Kategori Investor</td>
                        <td class="py-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                {{ $investor->jenis_investor ?? 'Umum' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Dana Tersedia (Alokasi)</td>
                        <td class="py-3 fs-5 fw-bold text-success">
                            Rp {{ number_format($investor->dana_tersedia, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted py-3">Tanggal Bergabung</td>
                        <td class="py-3 text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $investor->created_at ? $investor->created_at->translatedFormat('d F Y, H:i') : 'Data awal' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- KOLOM KANAN: FORM KEPUTUSAN VERIFIKASI --}}
    <div class="col-lg-5">
        <div class="dashboard-card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--navy);">
                <i class="bi bi-check2-circle me-2 text-success"></i>Keputusan Verifikasi
            </h5>
            <p class="text-muted small mb-4">
                Sebagai perwakilan pemerintah, tentukan apakah profil investor ini memenuhi syarat untuk berpartisipasi dan mendanai UMKM.
            </p>

            <form action="{{ route('pemerintah.verifikasi.investor.update', $investor->id_investor) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold" for="status_verifikasi">
                        Status Verifikasi <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-lg" name="status_verifikasi" id="status_verifikasi" required style="border-radius: 10px; font-size: 14px;">
                        <option value="">-- Pilih Keputusan --</option>
                        <option value="Terverifikasi" {{ old('status_verifikasi', $investor->status_verifikasi) === 'Terverifikasi' ? 'selected' : '' }}>
                            Setujui (Terverifikasi)
                        </option>
                        <option value="Ditolak" {{ old('status_verifikasi', $investor->status_verifikasi) === 'Ditolak' ? 'selected' : '' }}>
                            Tolak Verifikasi
                        </option>
                        <option value="Menunggu" {{ old('status_verifikasi', $investor->status_verifikasi) === 'Menunggu' ? 'selected' : '' }}>
                            Kembalikan ke Menunggu
                        </option>
                    </select>
                    <div class="form-text">
                        Investor berstatus "Terverifikasi" dapat melihat proposal UMKM dan mengajukan penawaran kerja sama pendanaan.
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" for="catatan">
                        Catatan Verifikasi (Opsional)
                    </label>
                    <textarea class="form-control"
                              name="catatan"
                              id="catatan"
                              rows="4"
                              placeholder="Tuliskan catatan verifikasi atau alasan penolakan jika ada..."
                              style="border-radius: 10px; font-size: 13px;">{{ old('catatan') }}</textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold" style="background: var(--navy); border-color: var(--navy); border-radius: 10px;">
                        <i class="bi bi-check-lg me-1"></i> Simpan Keputusan Verifikasi
                    </button>
                    <a href="{{ route('pemerintah.verifikasi.investor.index') }}" class="btn btn-light py-2 text-muted" style="border-radius: 10px;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
