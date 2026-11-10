@extends('layouts.investor')

@section('title', 'Profil Investor')
@section('navbar-title', 'Profil Saya')

@section('content')

<div class="page-heading">
    <h1>Profil Investor</h1>
    <p>Kelola informasi profil dan akun investasimu.</p>
</div>

@if (session('success_profil'))
<div class="alert alert-success">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success_profil') }}
</div>
@endif

@if (session('success_akun'))
<div class="alert alert-success">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success_akun') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Perubahan belum berhasil disimpan.</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="dashboard-card p-4 mb-4">

    <div class="mb-4">
        <h2 class="h5 mb-1">Profil Investasi</h2>
        <p class="text-muted mb-0">
            Informasi identitas dan dana yang tersedia untuk investasi.
        </p>
    </div>

    <form action="{{ route('investor.profil.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_investor" class="form-label">
                Nama Investor
            </label>
            <input
                type="text"
                id="nama_investor"
                name="nama_investor"
                class="form-control"
                value="{{ old('nama_investor', $investor->nama_investor) }}"
                maxlength="255"
                required>
        </div>

        <div class="mb-3">
            <label for="jenis_investor" class="form-label">
                Jenis Investor
            </label>
            <select
                id="jenis_investor"
                name="jenis_investor"
                class="form-select"
                required>
                <option value="">Pilih jenis investor</option>
                <option value="Individu"
                    {{ old('jenis_investor', $investor->jenis_investor) === 'Individu' ? 'selected' : '' }}>
                    Individu
                </option>
                <option value="Perusahaan"
                    {{ old('jenis_investor', $investor->jenis_investor) === 'Perusahaan' ? 'selected' : '' }}>
                    Perusahaan
                </option>
                <option value="Lembaga"
                    {{ old('jenis_investor', $investor->jenis_investor) === 'Lembaga' ? 'selected' : '' }}>
                    Lembaga
                </option>
            </select>
        </div>

        <div class="mb-4">
            <label for="dana_tersedia" class="form-label">
                Dana Tersedia (Rp)
            </label>
            <input
                type="number"
                id="dana_tersedia"
                name="dana_tersedia"
                class="form-control"
                value="{{ old('dana_tersedia', $investor->dana_tersedia) }}"
                min="0"
                step="1"
                required>
            <small class="text-muted">
                Masukkan jumlah dana yang tersedia untuk investasi.
            </small>
        </div>

        <div class="mb-4">
            <label class="form-label d-block">Status Verifikasi</label>

            @if ($investor->status_verifikasi === 'Terverifikasi')
            <span class="status-badge">
                Terverifikasi
            </span>
            @elseif ($investor->status_verifikasi === 'Menunggu Verifikasi')
            <span class="status-badge pending">
                Menunggu Verifikasi
            </span>
            @else
            <span class="badge text-bg-secondary">
                {{ $investor->status_verifikasi ?? 'Belum Diketahui' }}
            </span>
            @endif

            <small class="text-muted d-block mt-2">
                Status verifikasi dikelola oleh pihak pemerintah.
                Perubahan informasi profil dapat memerlukan verifikasi ulang.
            </small>
        </div>

        <div class="profile-form-actions">
            <a href="{{ route('investor.dashboard') }}"
                class="profile-btn profile-btn-secondary">
                Kembali
            </a>

            <button type="submit"
                class="profile-btn profile-btn-primary">
                <i class="bi bi-check2"></i>
                Simpan Perubahan
            </button>
        </div>


    </form>
</div>


<div class="dashboard-card p-4">

    <div class="mb-4">
        <h2 class="h5 mb-1">Keamanan Akun</h2>
        <p class="text-muted mb-0">
            Ubah username atau password untuk menjaga keamanan akunmu.
        </p>
    </div>

    <form action="{{ route('investor.akun.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="username" class="form-label">
                Username
            </label>
            <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                value="{{ old('username', $investor->username) }}"
                maxlength="255"
                required>
            <small class="text-muted">
                Username digunakan untuk login ke akun investor.
            </small>
        </div>

        <hr class="my-4">

        <h3 class="h6 mb-3">Ganti Password</h3>

        <div class="mb-3">
            <label for="password_lama" class="form-label">
                Password Lama
            </label>
            <input
                type="password"
                id="password_lama"
                name="password_lama"
                class="form-control"
                autocomplete="current-password"
                required>
            <small class="text-muted">
                Masukkan password saat ini untuk mengonfirmasi perubahan akun.
            </small>
        </div>

        <div class="mb-3">
            <label for="password_baru" class="form-label">
                Password Baru
            </label>
            <input
                type="password"
                id="password_baru"
                name="password_baru"
                class="form-control"
                minlength="8"
                autocomplete="new-password"
                placeholder="Minimal 8 karakter">
        </div>

        <div class="mb-4">
            <label for="password_baru_confirmation" class="form-label">
                Konfirmasi Password Baru
            </label>
            <input
                type="password"
                id="password_baru_confirmation"
                name="password_baru_confirmation"
                class="form-control"
                minlength="8"
                autocomplete="new-password"
                placeholder="Masukkan ulang password baru">
            <small class="text-muted">
                Kosongkan kedua kolom password baru jika tidak ingin menggantinya.
            </small>
        </div>

        <div class="profile-form-actions">
            <button type="submit"
                class="profile-btn profile-btn-primary">
                <i class="bi bi-check2"></i>
                Simpan Akun
            </button>
        </div>

    </form>
</div>

@endsection
