@extends('layouts.app')

@section('title', 'Masuk — MitraUMKM')

@section('content')

@php
$roleName = 'Investor';
$loginAction = route('investor.login.process');
$registerUrl = route('investor.register');

if ($role === 'pemerintah') {
$roleName = 'Pemerintah';
$loginAction = route('pemerintah.login.process');
$registerUrl = null;
} elseif ($role === 'umkm') {
$roleName = 'UMKM';
$loginAction = route('umkm.login.process');
$registerUrl = route('umkm.register');
}
@endphp

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
        background: #e4e6dc;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }

    .auth-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        color: #30382e;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: -0.4px;
    }

    .brand-mark {
        width: 27px;
        height: 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #394637;
        color: #fffefa;
        font-size: 13px;
        font-weight: 600;
    }

    .intro-main {
        margin: 70px 0 55px;
        max-width: 430px;
    }

    .intro-eyebrow {
        color: #afdbf8;
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

    .intro-bottom p {
        color: #62685d;
        font-size: 10px;
        line-height: 1.7;
        margin: 0;
    }

    .intro-bottom .edition {
        text-align: right;
        white-space: nowrap;
    }

    /* PANEL KANAN */

    .auth-form-panel {
        padding: 42px 54px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }

    .form-topline {
        color: #777a70;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        margin-bottom: 35px;
    }

    .form-heading {
        color: #282c26;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 35px;
        font-weight: 400;
        letter-spacing: -1px;
        line-height: 1.2;
        margin: 0 0 10px;
    }



    /* PILIHAN ROLE */

    .role-label {
        display: block;
        color: #676b61;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .role-tabs {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        border-bottom: 1px solid #dcdcd3;
        margin-bottom: 28px;
    }

    .role-tabs a {
        display: block;
        padding: 13px 4px 12px;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        color: #85867d;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .role-tabs a:hover {
        color: #394637;
    }

    .role-tabs a.active {
        color: #12253f;
        border-bottom-color: #12253f;
        font-weight: 700;
    }

    .selected-role {
        color: #12253f;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
        text-align: center;
    }

    .selected-role-description {
        color: #85867d;
        font-size: 11px;
        line-height: 1.7;
        margin-bottom: 22px;
        text-align: center;
    }

    /* INPUT */

    .auth-form-panel .form-label {
        color: #12253f;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .auth-form-panel .form-control {
        min-height: 45px;
        padding: 12px 13px;
        border: 1px solid #deded5;
        border-radius: 30px;
        background: #fffefa;
        color: #12253f;
        font-size: 12px;
        box-shadow: none;
    }

    .auth-form-panel .form-control::placeholder {
        color: #a4a59c;
    }

    .auth-form-panel .form-control:focus {
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
    font-size: 12px;
    font-weight: 600;
    transition: background 0.15s ease;
    }

    .auth-submit:hover {
        background: #12253f;
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
        color: #12253f;
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

        .form-topline {
            margin-bottom: 25px;
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



        .role-tabs a {
            font-size: 11px;
        }

        .intro-bottom .edition {
            white-space: normal;
        }
    }

    .form-heading {
        font-size: 30px;
        width: 100%;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    .form-subheading {
        color: #85867d;
        font-size: 12px;
        line-height: 1.8;
        margin-bottom: 28px;
        width: 100%;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
</style>

<div class="auth-page">
    <main class="auth-shell">

        {{-- KIRI --}}
        <section class="auth-intro" style="background: #cfdef4;border-radius: 20px">

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

            <div class="intro-bottom">
            </div>

        </section>

        {{-- KANAN --}}
        <section class="auth-form-panel">

            <h2 class="form-heading">Selamat datang, {{ $roleName }}</h2>

            <p class="form-subheading">
                Masuk ke akunmu untuk melanjutkan.
            </p>

            <nav class="role-tabs" aria-label="Pilih jenis akun">
                <a
                    href="{{ route('investor.login') }}"
                    class="{{ $role === 'investor' ? 'active' : '' }}"
                    @if ($role==='investor' ) aria-current="page" @endif>
                    Investor
                </a>

                <a
                    href="{{ route('pemerintah.login') }}"
                    class="{{ $role === 'pemerintah' ? 'active' : '' }}"
                    @if ($role==='pemerintah' ) aria-current="page" @endif>
                    Pemerintah
                </a>

                <a
                    href="{{ route('umkm.login') }}"
                    class="{{ $role === 'umkm' ? 'active' : '' }}"
                    @if ($role==='umkm' ) aria-current="page" @endif>
                    UMKM
                </a>
            </nav>

            @if (session('success'))
            <div class="alert alert-success auth-alert">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger auth-alert">
                Ada data yang belum sesuai. Periksa kembali
                username dan password kamu.
            </div>
            @endif

            <form method="POST" action="{{ $loginAction }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="Masukkan username"
                        autocomplete="username"
                        required
                        autofocus>

                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required>

                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn auth-submit">
                    Masuk ke akun
                </button>
            </form>

            @if ($registerUrl)
            <p class="auth-register">
                Belum memiliki akun?
                <a href="{{ $registerUrl }}">Daftar di sini</a>
            </p>
            @endif

        </section>

    </main>
</div>

@endsection
