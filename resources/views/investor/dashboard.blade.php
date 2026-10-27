@extends('layouts.investor')

@section('title', 'Dashboard Investor')
@section('navbar-title', 'Dashboard')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <div class="page-heading">
        <h1>Selamat datang kembali!</h1>
        <p>Pantau peluang investasi dan temukan inovasi UMKM yang potensial.</p>
    </div>

    {{-- PENGINGAT PROFIL --}}
    <div class="profile-alert">
        <div class="profile-alert-content">
            <div class="alert-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <div>
                <h3>Lengkapi profil investasimu</h3>
                <p>
                    Lengkapi informasi profil agar kamu dapat mengajukan penawaran
                    pendanaan dan menjalin kerja sama dengan UMKM.
                </p>
            </div>
        </div>

        {{-- Sementara menuju bagian profil --}}
        <a href="#profil" class="btn-dashboard">
            Lengkapi Profil
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="section-heading">
        <div>
            <h2>Ringkasan Aktivitas</h2>
            <p>Gambaran aktivitas investasi kamu.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">

        {{-- TOTAL INOVASI --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="dashboard-card stat-card">
                <div class="stat-top">
                    <div class="stat-label">Total Inovasi</div>
                    <div class="stat-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                </div>

                <div class="stat-value">0</div>
                <div class="stat-description">
                    Inovasi yang tersedia di platform
                </div>
            </div>
        </div>

        {{-- INOVASI BERJALAN --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="dashboard-card stat-card">
                <div class="stat-top">
                    <div class="stat-label">Investasi Berjalan</div>
                    <div class="stat-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>

                <div class="stat-value">0</div>
                <div class="stat-description">
                    Kerja sama pendanaan yang sedang berjalan
                </div>
            </div>
        </div>

        {{-- INOVASI DENGAN PENAWARAN TERBANYAK --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="dashboard-card stat-card">
                <div class="stat-top">
                    <div class="stat-label">Penawaran Terbanyak</div>
                    <div class="stat-icon">
                        <i class="bi bi-fire"></i>
                    </div>
                </div>

                <div class="stat-value">—</div>
                <div class="stat-description">
                    Inovasi dengan jumlah penawaran tertinggi
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL INOVASI --}}
    <div class="dashboard-card table-card">

        <div class="table-card-header">
            <div>
                <h2>Inovasi yang Sedang Berjalan</h2>
                <p>Pantau perkembangan kerja sama pendanaanmu.</p>
            </div>

            <a href="#investasi" class="btn-dashboard">
                Lihat Semua
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Nama Inovasi</th>
                        <th>Pelaku UMKM</th>
                        <th>Nilai Pendanaan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Data akan dihubungkan ke database nanti --}}
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="bi bi-folder2-open"></i>
                                <h3>Belum ada investasi berjalan</h3>
                                <p>
                                    Kerja sama pendanaan yang sudah berjalan
                                    akan ditampilkan di bagian ini.
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection
