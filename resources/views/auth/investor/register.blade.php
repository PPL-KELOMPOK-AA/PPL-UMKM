@extends('layouts.app')

@section('title', 'Daftar — MitraUMKM')

@section('content')

<style>
    body {
        background: #efeee9 !important;
        color: #242923;
        font-family: "Inter", Arial, sans-serif;
        font-weight: 400;
        -webkit-font-smoothing: antialiased;
    }

    .auth-page {
        min-height: 100vh;
        padding: 36px 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-shell {
        width: 100%;
        max-width: 1120px;
        min-height: 650px;
        display: grid;
        grid-template-columns: 1fr 0.92fr;
        background: #fffefa;
        border: 1px solid #deded5;
        overflow: hidden;
    }

    /* PANEL KIRI */

    .auth-intro {
        padding: 38px 42px 32px;
        background: #cfdef4;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }

    .intro-main {
        margin: 70px 0 55px;
        max-width: 430px;
    }

    .intro-eyebrow {
        color: #5676a4;
        font-size: 10px;
        font-weight: 300;
        letter-spacing: 2px;
        margin-bottom: 24px;
        font-family: "Inter", Arial, sans-serif;
    }

    .intro-title {
        color: #12253f;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(39px, 4.1vw, 58px);
        font-weight: 400;
        letter-spacing: -2.2px;
        margin: 0 0 24px;
    }

    .intro-description {
        max-width: 345px;
        color: #12253f;
        font-size: 13px;
        line-height: 1.9;
        margin: 0;
    }

    .intro-bottom {
        border-top: 1px solid #91bfff;
        padding-top: 17px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }

    /* PANEL KANAN */

    .auth-form-panel {
        padding: 42px 54px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }

    .form-heading {
        color: #282c26;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 30px;
        font-weight: 400;
        letter-spacing: -1px;
        line-height: 1.2;
        margin: 0 auto 10px;
        width: 100%;
        text-align: center;
    }

    .form-subheading {
        color: #85867d;
        font-size: 12px;
        line-height: 1.8;
        margin: 0 auto 28px;
        width: 100%;
        text-align: center;
    }

    /* INPUT */

    .auth-form-panel .form-label {
        color: #12253f;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .auth-form-panel .form-control,
    .auth-form-panel .form-select {
        min-height: 45px;
        padding: 12px 13px;
        border: 1px solid #deded5;
        border-radius: 30px;
        background-color: #fffefa;
        color: #12253f;
        font-family: "Inter", Arial, sans-serif;
        font-size: 12px;
        box-shadow: none;
    }

    .auth-form-panel .form-control::placeholder {
        color: #a4a59c;
    }

    .auth-form-panel .form-control:focus,
    .auth-form-panel .form-select:focus {
        border-color: #5895ea;
        box-shadow: 0 0 0 2px rgba(101, 116, 91, 0.10);
    }

    .auth-form-panel .mb-3 {
        margin-bottom: 19px !important;
    }

    .auth-submit {
        width: 100%;
        min-height: 46px;
        margin-top: 5px;
        padding: 12px 16px;
        border: 1px solid #12253f;
        border-radius: 30px;
        background: #12253f;
        color: #fffefa;
        font-family: "Inter", Arial, sans-serif;
        font-size: 12px;
        font-weight: 600;
        transition: background 0.15s ease;
    }

    .auth-submit:hover {
        background: #5676a4;
        border-color: #5676a4;
        color: #fffefa;
    }

    .auth-register {
        margin: 24px 0 0;
        color: #12253f;
        font-size: 11px;
        text-align: center;
    }

    .auth-register a {
        color: #12253f;
        font-weight: 700;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .auth-back {
        display: block;
        margin-top: 28px;
        color: #12253f;
        font-size: 10px;
        text-align: center;
        text-decoration: none;
    }

    .auth-back:hover {
        color: #5676a4;
    }

    .auth-alert {
        border-radius: 2px;
        font-size: 11px;
        line-height: 1.7;
    }

    /* RESPONSIVE */

    @media (max-width: 850px) {
        .auth-page {
            padding: 20px;
        }

        .auth-shell {
            max-width: 560px;
            grid-template-columns: 1fr;
        }

        .auth-intro {
            padding: 28px;
        }

        .intro-main {
            margin: 45px 0;
        }

        .intro-title {
            font-size: 43px;
        }

        .auth-form-panel {
            padding: 35px 28px;
        }
    }

    @media (max-width: 420px) {
        .auth-page {
            padding: 10px;
        }

        .auth-intro,
        .auth-form-panel {
            padding: 24px 20px;
        }

        .intro-title {
            font-size: 38px;
        }
    }
</style>

<div class="auth-page">
    <main class="auth-shell">

        {{-- PANEL KIRI --}}
        <section class="auth-intro">

            <div class="intro-main">
                <div class="intro-eyebrow">
                    TUGAS BESAR KELOMPOK A
                </div>

                <h1 class="intro-title">
                    Membantu<br>
                    bisnis<br>
                    <i style="color: #5676a4;">semakin inovatif</i>
                </h1>

                <p class="intro-description">
                    Mempertemukan pelaku UMKM, investor, dan pemerintah
                    untuk membuka peluang usaha serta mendorong inovasi
                    ekonomi daerah.
                </p>
            </div>

            <div class="intro-bottom"></div>

        </section>

        {{-- PANEL KANAN: FORM REGISTER --}}
        <section class="auth-form-panel">

            <h2 class="form-heading">Buat Akun Investor</h2>

            <p class="form-subheading">
                Daftarkan dirimu untuk bergabung dengan MitraUMKM.
            </p>

            @if (session('success'))
                <div class="alert alert-success auth-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger auth-alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('investor.register.process') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama_investor" class="form-label">
                        Nama Investor
                    </label>
                    <input
                        type="text"
                        id="nama_investor"
                        name="nama_investor"
                        value="{{ old('nama_investor') }}"
                        class="form-control @error('nama_investor') is-invalid @enderror"
                        placeholder="Masukkan nama investor"
                        required
                    >
                    @error('nama_investor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_investor" class="form-label">
                        Jenis Investor
                    </label>
                    <select
                        id="jenis_investor"
                        name="jenis_investor"
                        class="form-select @error('jenis_investor') is-invalid @enderror"
                        required
                    >
                        <option value="">Pilih jenis investor</option>
                        <option value="Individu" {{ old('jenis_investor') == 'Individu' ? 'selected' : '' }}>
                            Individu
                        </option>
                        <option value="Perusahaan" {{ old('jenis_investor') == 'Perusahaan' ? 'selected' : '' }}>
                            Perusahaan
                        </option>
                        <option value="Lembaga" {{ old('jenis_investor') == 'Lembaga' ? 'selected' : '' }}>
                            Lembaga
                        </option>
                    </select>
                    @error('jenis_investor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="Buat username"
                        autocomplete="username"
                        required
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Buat password"
                        autocomplete="new-password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit" class="btn auth-submit">
                    Daftar sebagai Investor
                </button>
            </form>

            <p class="auth-register">
                Sudah punya akun?
                <a href="{{ route('investor.login') }}">Login di sini</a>
            </p>

        </section>

    </main>
</div>

@endsection
