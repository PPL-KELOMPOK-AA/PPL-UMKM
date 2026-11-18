@extends('layouts.pemerintah')

@section('title', 'Tinjau Profil UMKM: ' . $umkm->nama_usaha)
@section('navbar-title', 'Tinjau Profil UMKM')

@section('content')

{{-- PAGE HEADING & BACK BUTTON --}}
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
        <a href="{{ route('pemerintah.umkm.index') }}" class="btn btn-outline-secondary btn-sm mb-2" style="border-radius: 8px;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Verifikasi
        </a>
        <h1 class="h3 fw-bold text-dark mb-1">{{ $umkm->nama_usaha }}</h1>
        <p class="text-muted small mb-0">Tinjau profil dan legalitas usaha, lalu putuskan status verifikasi UMKM ini.</p>
    </div>

    <div>
        @if($umkm->status_verifikasi === 'Terverifikasi')
            <span class="status-badge fs-6 px-3 py-2"><i class="bi bi-shield-check me-1"></i> Terverifikasi</span>
        @elseif($umkm->status_verifikasi === 'Ditolak')
            <span class="status-badge rejected fs-6 px-3 py-2"><i class="bi bi-shield-x me-1"></i> Ditolak</span>
        @else
            <span class="status-badge pending fs-6 px-3 py-2"><i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi</span>
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
    {{-- KOLOM KIRI: PROFIL UMKM --}}
    <div class="col-lg-7">
        <div class="dashboard-card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--navy);">
                <i class="bi bi-shop me-2 text-primary"></i>Informasi Profil & Legalitas UMKM
            </h5>

            <table class="table table-borderless align-middle mb-0">
                <tbody>
                    <tr class="border-bottom">
                        <td class="text-muted py-3" style="width: 200px;">ID UMKM</td>
                        <td class="fw-semibold py-3">#UMKM-{{ str_pad($umkm->id_UMKM, 4, '0', STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Nama Usaha</td>
                        <td class="fw-bold py-3 text-dark">{{ $umkm->nama_usaha }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Username Akun</td>
                        <td class="py-3">
                            <span class="badge bg-light text-dark border"><i class="bi bi-at"></i>{{ $umkm->username }}</span>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">NIB (Legalitas)</td>
                        <td class="fw-semibold py-3">{{ $umkm->NIB ?? '-' }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Bidang Usaha</td>
                        <td class="py-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                {{ $umkm->bidang_usaha ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Alamat</td>
                        <td class="py-3">{{ $umkm->alamat ?? '-' }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-3">Proposal Diajukan</td>
                        <td class="py-3">{{ $umkm->proposals_count }} proposal</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-3">Tanggal Daftar</td>
                        <td class="py-3 text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $umkm->created_at ? $umkm->created_at->format('d M Y, H:i') : '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- KOLOM KANAN: FORM KEPUTUSAN --}}
    <div class="col-lg-5">
        <div class="dashboard-card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--navy);">
                <i class="bi bi-check2-circle me-2 text-success"></i>Keputusan Verifikasi
            </h5>
            <p class="text-muted small mb-4">
                Pastikan NIB dan data usaha valid sebelum menyetujui UMKM untuk mengajukan proposal pendanaan.
            </p>

            <form action="{{ route('pemerintah.umkm.update', $umkm->id_UMKM) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label fw-semibold" for="status_verifikasi">
                        Status Verifikasi <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-select-lg" name="status_verifikasi" id="status_verifikasi" required style="border-radius: 10px; font-size: 14px;">
                        <option value="">-- Pilih Keputusan --</option>
                        <option value="Terverifikasi" {{ old('status_verifikasi', $umkm->status_verifikasi) === 'Terverifikasi' ? 'selected' : '' }}>Setujui (Terverifikasi)</option>
                        <option value="Ditolak" {{ old('status_verifikasi', $umkm->status_verifikasi) === 'Ditolak' ? 'selected' : '' }}>Tolak Verifikasi</option>
                        <option value="Menunggu Verifikasi" {{ old('status_verifikasi', $umkm->status_verifikasi) === 'Menunggu Verifikasi' ? 'selected' : '' }}>Kembalikan ke Menunggu Verifikasi</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fw-semibold" style="background: var(--navy); border-color: var(--navy); border-radius: 10px;">
                        <i class="bi bi-check-lg me-1"></i> Simpan Keputusan Verifikasi
                    </button>
                    <a href="{{ route('pemerintah.umkm.index') }}" class="btn btn-light py-2 text-muted" style="border-radius: 10px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
