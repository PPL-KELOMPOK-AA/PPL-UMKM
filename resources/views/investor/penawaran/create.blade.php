@extends('layouts.investor')

@section('title', 'Ajukan Penawaran')
@section('navbar-title', 'Ajukan Penawaran')

@section('content')

<style>
    .back-link { display: inline-block; margin-bottom: 14px; color: var(--text-muted); font-size: 13px; }
    .back-link:hover { color: var(--navy); }

    .form-card { padding: 32px 34px; border-radius: 14px; }
    .form-title { margin: 0 0 4px; color: var(--navy); font-size: 22px; font-weight: 600; }
    .form-sub { margin: 0 0 24px; color: var(--text-muted); font-size: 13px; }

    .field { margin-bottom: 20px; }
    .field label { display: block; margin-bottom: 6px; color: var(--navy); font-size: 13px; font-weight: 600; }
    .field input, .field textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #fafbfd;
        color: var(--text-dark);
        font-size: 13px;
        outline: none;
        padding: 12px 14px;
    }
    .field input { height: 44px; }
    .field textarea { min-height: 120px; resize: vertical; }
    .field input:focus, .field textarea:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px var(--blue-soft);
    }
    .field .hint { margin-top: 6px; color: var(--text-muted); font-size: 12px; }
    .field .err { margin-top: 6px; color: #bc2c2c; font-size: 12px; }

    .sum-label { color: var(--text-muted); font-size: 12px; }
    .sum-dana { margin: 4px 0 16px; color: var(--navy); font-size: 24px; font-weight: 700; }
    .sum-title { margin: 0 0 14px; color: var(--navy); font-size: 14px; font-weight: 600; }
    .side-card { padding: 24px; border-radius: 14px; }
    .side-sticky { position: sticky; top: 20px; }
    .btn-batal { display: block; margin-top: 10px; text-align: center; color: var(--text-muted); font-size: 13px; }
    .btn-batal:hover { color: var(--navy); }

    @media (max-width: 991px) { .side-sticky { position: static; } }
</style>

<a href="{{ route('investor.proposal.show', $proposal->id_proposal) }}" class="back-link">&larr; Kembali ke detail proposal</a>

<div class="row g-3">

    {{-- KIRI: FORM --}}
    <div class="col-lg-8">
        <form method="POST" action="{{ route('investor.penawaran.store', $proposal->id_proposal) }}"
              class="dashboard-card form-card">
            @csrf

            <h1 class="form-title">Ajukan penawaran pendanaan</h1>
            <p class="form-sub">Isi jumlah dana dan persyaratan. UMKM akan memilih satu dari semua penawaran yang masuk.</p>

            <div class="field">
                <label for="jumlah_dana">Jumlah dana (Rp)</label>
                <input type="number" id="jumlah_dana" name="jumlah_dana" min="1"
                       value="{{ old('jumlah_dana', (int) $proposal->dana_dibutuhkan) }}" required>
                <div class="hint">Dana tersedia kamu Rp {{ number_format($danaInvestor, 0, ',', '.') }}</div>
                @error('jumlah_dana') <div class="err">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="persyaratan">Persyaratan</label>
                <textarea id="persyaratan" name="persyaratan" maxlength="255"
                          placeholder="Contoh: bagi hasil 10%, laporan keuangan tiap bulan" required>{{ old('persyaratan') }}</textarea>
                <div class="hint">Maksimal 255 karakter.</div>
                @error('persyaratan') <div class="err">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-dashboard">Kirim penawaran</button>
        </form>
    </div>

    {{-- KANAN: RINGKASAN --}}
    <div class="col-lg-4">
        <div class="side-sticky">
            <div class="dashboard-card side-card">
                <h3 class="sum-title">Ringkasan proposal</h3>

                <div class="sum-label">{{ $proposal->nama_usaha }} &middot; {{ $proposal->bidang_usaha }}</div>
                <div style="margin: 4px 0 16px; color: var(--navy); font-weight: 600;">{{ $proposal->judul }}</div>

                <div class="sum-label">Dana dibutuhkan</div>
                <div class="sum-dana">Rp {{ number_format($proposal->dana_dibutuhkan, 0, ',', '.') }}</div>

                <a href="{{ route('investor.proposal.show', $proposal->id_proposal) }}" class="btn-batal">Batal</a>
            </div>
        </div>
    </div>

</div>

@endsection