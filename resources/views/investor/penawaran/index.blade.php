@extends('layouts.investor')

@section('title', 'Penawaran Saya')
@section('navbar-title', 'Penawaran Saya')

@section('content')

<style>
    .alert-box { padding: 12px 16px; margin-bottom: 14px; border-radius: 10px; font-size: 13px; }
    .alert-ok { background: #e8f6ee; color: #1f7a45; }
    .alert-err { background: #fdecec; color: #bc2c2c; }

    .pn-list { display: grid; gap: 14px; }
    .pn-card { padding: 20px 22px; border-radius: 12px; }
    .pn-top { display: flex; justify-content: space-between; gap: 10px; font-size: 12px; }
    .pn-umkm { color: var(--text-dark); font-weight: 600; }
    .pn-date { color: var(--text-muted); }
    .pn-title { margin: 10px 0 6px; color: var(--navy); font-size: 16px; font-weight: 600; }
    .pn-syarat { margin: 0 0 16px; color: var(--text-muted); font-size: 12.5px; line-height: 1.7; }

    .pn-foot {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }
    .pn-label { color: var(--text-muted); font-size: 11px; }
    .pn-dana { color: var(--navy); font-size: 16px; font-weight: 700; }

    .badge-status { padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .st-menunggu { background: #fff4db; color: #a8730a; }
    .st-diterima { background: #e8f6ee; color: #1f7a45; }
    .st-ditolak  { background: #fdecec; color: #bc2c2c; }

    .empty-box { padding: 50px 20px; text-align: center; color: var(--text-muted); font-size: 13px; }
</style>

<div class="page-heading">
    <h1>Penawaran Saya</h1>
    <p>Penawaran pendanaan yang sudah kamu ajukan ke UMKM.</p>
</div>

@if (session('success'))
    <div class="alert-box alert-ok">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert-box alert-err">{{ session('error') }}</div>
@endif

@if ($penawarans->count() > 0)
    <div class="pn-list">
        @foreach ($penawarans as $pn)
            <div class="dashboard-card pn-card">

                <div class="pn-top">
                    <span class="pn-umkm">{{ $pn->proposal->umkm->nama_usaha ?? '-' }}</span>
                    <span class="pn-date">
                        Diajukan {{ \Carbon\Carbon::parse($pn->tanggal_penawaran)->format('d M Y') }}
                    </span>
                </div>

                <h3 class="pn-title">{{ $pn->proposal->judul ?? 'Proposal tidak ditemukan' }}</h3>
                <p class="pn-syarat">Persyaratan: {{ $pn->persyaratan }}</p>

                <div class="pn-foot">
                    <div>
                        <div class="pn-label">Dana yang kamu tawarkan</div>
                        <div class="pn-dana">Rp {{ number_format($pn->jumlah_dana, 0, ',', '.') }}</div>
                    </div>
                    <span class="badge-status st-{{ $pn->status }}">{{ ucfirst($pn->status) }}</span>
                </div>

            </div>
        @endforeach
    </div>
@else
    <div class="dashboard-card empty-box">
        Kamu belum mengajukan penawaran apa pun.
    </div>
@endif

@endsection