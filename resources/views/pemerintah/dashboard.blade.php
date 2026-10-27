
@extends('layouts.pemerintah')

@section('title', 'Dashboard Pemerintah')
@section('navbar-title', 'Dashboard')

@section('content')

<div class="page-heading">
    <h1>Dashboard Monitoring</h1>
    <p>Pantau perkembangan UMKM, inovasi, dan kolaborasi dalam platform MitraUMKM.</p>
</div>

<div class="section-heading">
    <div>
        <h2>Ringkasan Platform</h2>
        <p>Gambaran umum aktivitas MitraUMKM.</p>
    </div>
</div>

<div class="row g-3">

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total UMKM</span>
                <div class="stat-icon">
                    <i class="bi bi-shop"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">
                Jumlah UMKM yang terdaftar di platform.
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Inovasi</span>
                <div class="stat-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">
                Jumlah inovasi yang telah didaftarkan UMKM.
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Kolaborasi Berjalan</span>
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">
                Jumlah kerja sama UMKM dan investor yang berjalan.
            </p>
        </div>
    </div>

</div>

<div class="dashboard-card table-card">
    <div class="table-card-header">
        <div>
            <h2>Inovasi Terbaru</h2>
            <p>Pantau inovasi yang baru didaftarkan oleh UMKM.</p>
        </div>

        <a href="#inovasi" class="btn-dashboard">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Nama Inovasi</th>
                    <th>Nama UMKM</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="4" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada data inovasi untuk ditampilkan.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="dashboard-card table-card">
    <div class="table-card-header">
        <div>
            <h2>Kolaborasi Terbaru</h2>
            <p>Pantau kerja sama antara UMKM dan investor.</p>
        </div>

        <a href="#kolaborasi" class="btn-dashboard btn-dashboard-outline">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Nama UMKM</th>
                    <th>Nama Investor</th>
                    <th>Nama Inovasi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="4" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada data kolaborasi untuk ditampilkan.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
