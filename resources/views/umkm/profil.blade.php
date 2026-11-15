@extends('layouts.umkm')

@section('title', 'Profil Usaha UMKM')
@section('navbar-title', 'Profil Usaha')

@section('content')

<div class="page-heading">
    <h1>Profil Usaha</h1>
    <p>Informasi identitas usaha dan legalitas akun MitraUMKM milikmu.</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="dashboard-card p-4 p-md-5">
            <div class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom">
                <div>
                    <h2 class="h5 fw-bold mb-1" style="color: var(--navy); font-family: 'Manrope', 'Inter', sans-serif;">
                        <i class="bi bi-shop text-primary me-2"></i>Data Usaha
                    </h2>
                    <p class="text-muted small mb-0">Informasi terdaftar usaha dan nomor izin berusaha.</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0" style="font-size: 13.5px;">
                    <tbody>
                        <tr class="border-bottom">
                            <td class="text-muted py-3" style="width: 200px;">Nama Usaha</td>
                            <td class="fw-bold py-3 text-dark">{{ $umkm->nama_usaha }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-muted py-3">Username Akun</td>
                            <td class="py-3">
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-at"></i>{{ $umkm->username }}
                                </span>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-muted py-3">Nomor Induk Berusaha (NIB)</td>
                            <td class="fw-semibold py-3">{{ $umkm->NIB }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-muted py-3">Bidang Usaha</td>
                            <td class="py-3">
                                <span class="badge" style="background: var(--blue-soft); color: var(--navy);">
                                    {{ $umkm->bidang_usaha }}
                                </span>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-muted py-3">Alamat Usaha</td>
                            <td class="py-3 text-dark">{{ $umkm->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-3">Status Verifikasi</td>
                            <td class="py-3">
                                @if($umkm->status_verifikasi === 'Terverifikasi')
                                    <span class="status-badge">
                                        <i class="bi bi-check-circle me-1"></i> Terverifikasi
                                    </span>
                                @elseif($umkm->status_verifikasi === 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger border px-2 py-1">
                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border px-2 py-1">
                                        <i class="bi bi-hourglass-split me-1"></i> {{ $umkm->status_verifikasi ?? 'Menunggu Verifikasi' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pt-4 border-top mt-4">
                <a href="{{ route('umkm.dashboard') }}" class="btn-dashboard btn-dashboard-outline">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dashboard-card p-4 mb-4">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="stat-icon" style="width: 36px; height: 36px; font-size: 17px;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="h6 fw-bold mb-0" style="color: var(--navy);">Verifikasi Usaha</h3>
            </div>
            <p class="text-muted small mb-2">
                Status akun usahamu dikelola dan ditinjau langsung oleh pemerintah/dinas terkait.
            </p>
            <p class="text-muted small mb-0">
                Akun yang berstatus <strong>Terverifikasi</strong> dapat mengajukan proposal proyek dan mendapatkan tawaran pendanaan investor.
            </p>
        </div>
    </div>
</div>

@endsection
