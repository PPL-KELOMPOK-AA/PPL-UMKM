@extends('layouts.umkm')

@section('title', 'Profil Akun')
@section('navbar-title', 'Profil Akun')

@section('content')

<div class="page-heading">
    <h1>Profil Akun</h1>
    <p>Kelola informasi akun dan identitas usaha kamu.</p>
</div>

<div class="dashboard-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Informasi Akun UMKM</h3>
            <p class="text-muted mb-0">
                Informasi akun yang terdaftar pada MitraUMKM.
            </p>
        </div>

        <a href="{{ route('umkm.profil.edit') }}"
           class="btn btn-primary">
            Edit Profil
        </a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="text-muted">Username</label>
            <p class="fw-semibold">{{ $umkm->username }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Nama Usaha</label>
            <p class="fw-semibold">{{ $umkm->nama_usaha }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Nomor Induk Berusaha (NIB)</label>
            <p class="fw-semibold">{{ $umkm->NIB }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Bidang Usaha</label>
            <p class="fw-semibold">{{ $umkm->bidang_usaha }}</p>
        </div>

        <div class="col-md-12 mb-3">
            <label class="text-muted">Alamat</label>
            <p class="fw-semibold">{{ $umkm->alamat }}</p>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Status Verifikasi</label>
            <p class="fw-semibold">
                {{ $umkm->status_verifikasi }}
            </p>
        </div>
    </div>
</div>

@endsection