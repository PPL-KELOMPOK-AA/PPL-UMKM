@extends('layouts.app')
@section('title', 'Selamat Datang')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Platform Pendanaan UMKM</h1>
        <p class="text-muted">Masuk sesuai peran kamu</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body p-4">
                    <h4>UMKM</h4>
                    <p class="text-muted">Ajukan proposal dan pantau progres pendanaan.</p>
                    <a href="{{ route('umkm.login') }}" class="btn btn-primary w-100 mb-2">Login</a>
                    <a href="{{ route('umkm.register') }}" class="btn btn-outline-primary w-100">Daftar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body p-4">
                    <h4>Investor</h4>
                    <p class="text-muted">Lihat proposal dan berikan penawaran pendanaan.</p>
                    <a href="{{ route('investor.login') }}" class="btn btn-success w-100 mb-2">Login</a>
                    <a href="{{ route('investor.register') }}" class="btn btn-outline-success w-100">Daftar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body p-4">
                    <h4>Pemerintah</h4>
                    <p class="text-muted">Verifikasi akun dan kelola regulasi.</p>
                    <a href="{{ route('pemerintah.login') }}" class="btn btn-dark w-100">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
