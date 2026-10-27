@extends('layouts.pemerintah')

@section('title', 'Verifikasi Profil Investor')
@section('navbar-title', 'Verifikasi Investor')

@section('content')

{{-- PAGE HEADING --}}
<div class="page-heading">
    <h1>Verifikasi Profil Investor</h1>
    <p>Tinjau dan validasi profil para investor untuk memastikan kepatuhan dan kredibilitas pada platform MitraUMKM.</p>
</div>

{{-- NOTIFIKASI FLASH --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 14px;">
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 14px;">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- RINGKASAN STATISTIK --}}
<div class="section-heading mb-3">
    <div>
        <h2>Status Verifikasi</h2>
        <p>Ringkasan permohonan verifikasi akun investor.</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Investor</span>
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <h3 class="stat-value">{{ $totalInvestor }}</h3>
            <p class="stat-description">Total seluruh akun investor terdaftar.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Menunggu Verifikasi</span>
                <div class="stat-icon" style="background: #fff3dc; color: #a8751b;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <h3 class="stat-value" style="color: #a8751b;">{{ $menungguCount }}</h3>
            <p class="stat-description">Memerlukan peninjauan dan keputusan dari pemerintah.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Investor Terverifikasi</span>
                <div class="stat-icon" style="background: #e8f6ed; color: #328253;">
                    <i class="bi bi-shield-check"></i>
                </div>
            </div>
            <h3 class="stat-value" style="color: #328253;">{{ $terverifikasiCount }}</h3>
            <p class="stat-description">Telah disetujui untuk memberi penawaran pendanaan.</p>
        </div>
    </div>
</div>

{{-- TABEL DAFTAR INVESTOR --}}
<div class="dashboard-card table-card">
    <div class="table-card-header">
        <div>
            <h2>Daftar Pengajuan Profil Investor</h2>
            <p>Pilih akun investor untuk meninjau rincian profil dan dokumen pendukung.</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Investor</th>
                    <th>Username</th>
                    <th>Kategori / Jenis</th>
                    <th>Dana Tersedia</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($investors as $index => $investor)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="project-name fw-semibold">{{ $investor->nama_investor }}</span>
                        </td>
                        <td>
                            <code class="text-muted">{{ '@' . $investor->username }}</code>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1" style="font-weight: 500;">
                                {{ $investor->jenis_investor ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <strong>Rp {{ number_format($investor->dana_tersedia, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            @if($investor->status_verifikasi === 'Terverifikasi')
                                <span class="status-badge">
                                    <i class="bi bi-check-circle me-1"></i> Terverifikasi
                                </span>
                            @elseif($investor->status_verifikasi === 'Ditolak')
                                <span class="status-badge rejected">
                                    <i class="bi bi-x-circle me-1"></i> Ditolak
                                </span>
                            @else
                                <span class="status-badge pending">
                                    <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('pemerintah.verifikasi.investor.show', $investor->id_investor) }}"
                               class="btn-dashboard"
                               style="padding: 7px 14px; font-size: 11px;">
                                <i class="bi bi-search"></i> Tinjau Profil
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                            <h3>Belum Ada Data Investor</h3>
                            <p class="text-muted">Saat ini belum ada data permohonan verifikasi investor yang masuk.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
