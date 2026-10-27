@extends('layouts.umkm')

@section('title', 'Dashboard UMKM')
@section('navbar-title', 'Dashboard')

@section('content')

<div class="page-heading">
    <h1>Selamat datang kembali!</h1>
    <p>Kelola inovasi usahamu, pantau penawaran investor, dan kembangkan peluang kerja sama.</p>
</div>

<div class="profile-alert">
    <div class="profile-alert-content">
        <div class="alert-icon">
            <i class="bi bi-building-check"></i>
        </div>

        <div>
            <h3>Lengkapi profil usahamu</h3>
            <p>Lengkapi informasi usaha agar inovasimu lebih mudah ditemukan oleh investor dan mitra potensial.</p>
        </div>
    </div>

    <a href="#profil" class="btn-dashboard">
        Lengkapi Profil <i class="bi bi-arrow-right"></i>
    </a>
</div>

<div class="section-heading">
    <div>
        <h2>Ringkasan Aktivitas</h2>
        <p>Gambaran aktivitas inovasi dan kerja sama usahamu.</p>
    </div>
</div>

<div class="row g-3">

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Inovasi</span>
                <div class="stat-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">Total inovasi yang telah kamu buat.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Inovasi Berjalan</span>
                <div class="stat-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">Inovasi yang sedang dalam proses kerja sama.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Penawaran Investor</span>
                <div class="stat-icon">
                    <i class="bi bi-handshake"></i>
                </div>
            </div>

            <h3 class="stat-value">0</h3>
            <p class="stat-description">Penawaran yang masuk untuk inovasimu.</p>
        </div>
    </div>

</div>

<div class="dashboard-card table-card">
    <div class="table-card-header">
        <div>
            <h2>Inovasi Saya</h2>
            <p>Pantau inovasi yang telah kamu daftarkan.</p>
        </div>

        <a href="#inovasi" class="btn-dashboard">
            Tambah Inovasi <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Nama Inovasi</th>
                    <th>Kategori</th>
                    <th>Penawaran Investor</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="4" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada inovasi yang terdaftar.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
