@extends('layouts.investor')

@section('title', 'Daftar Inovasi')
@section('navbar-title', 'Daftar Inovasi')

@section('content')

<style>
    .proposal-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        padding: 14px;
        margin-bottom: 14px;
    }
    .search-box {
        position: relative;
        flex: 1;
        min-width: 220px;
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }
    .search-box input,
    .filter-select {
        width: 100%;
        height: 44px;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #fafbfd;
        color: var(--text-dark);
        font-size: 13px;
        outline: none;
    }
    .search-box input { padding: 0 14px 0 40px; }
    .filter-select { width: 220px; padding: 0 14px; }
    .search-box input:focus,
    .filter-select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px var(--blue-soft);
    }
    .result-info {
        margin-bottom: 18px;
        color: var(--text-muted);
        font-size: 12px;
    }

    .proposal-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 16px;
    }
    .p-card {
        display: flex;
        flex-direction: column;
        padding: 20px 22px;
        border-radius: 12px;
        color: inherit;
        transition: border-color 0.15s ease;
    }
    .p-card:hover { border-color: var(--blue); color: inherit; }

    .p-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        font-size: 12px;
    }
    .p-umkm { color: var(--text-dark); font-weight: 600; }
    .p-bidang { color: var(--text-muted); }

    .p-title {
        margin: 10px 0 6px;
        color: var(--navy);
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
    }
    .p-desc {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin: 0 0 18px;
        color: var(--text-muted);
        font-size: 12.5px;
        line-height: 1.7;
    }
    .p-foot {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }
    
    .p-label { 
        color: var(--text-muted); 
        font-size: 11px; 
    }

    .p-dana { 
        color: var(--navy); 
        font-size: 16px; 
        font-weight: 700; 
    }

    .p-date {
        color: var(--text-muted); 
        font-size: 12px; 
    }

        .p-card-off {
        background: #f7f8fa;
        pointer-events: none;
    }

    .p-card-off .p-title,
    .p-card-off .p-dana,
    .p-card-off .p-umkm { 
        color: #9aa5b5; 
    }

    .p-warn {
        color: #bc2c2c;
        font-size: 12px;
        font-weight: 600;
    }

    .empty-box {
        padding: 50px 20px;
        text-align: center;
        color: var(--text-muted);
        font-size: 13px;
    }
</style>

<div class="page-heading">
    <h1>Daftar Inovasi</h1>
    <p>Proposal dari UMKM yang sedang mencari pendanaan.</p>
</div>

{{-- Cari, filt --}}
<form method="GET" class="dashboard-card proposal-toolbar">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul proposal">
    </div>

    <select name="bidang" class="filter-select" onchange="this.form.submit()">
        <option value="">Semua bidang usaha</option>
        @foreach ($bidangList as $bidang)
            <option value="{{ $bidang }}" {{ request('bidang') == $bidang ? 'selected' : '' }}>
                {{ $bidang }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn-dashboard">Cari</button>
</form>

<div class="result-info">
    {{ $proposals->total() }} proposal ditemukan. Dana tersedia kamu Rp {{ number_format($danaInvestor, 0, ',', '.') }}
</div>


@if ($proposals->count() > 0)
    <div class="proposal-grid">
        @foreach ($proposals as $p)
    @php $cukup = $danaInvestor >= $p->dana_dibutuhkan; @endphp

    <a href="{{ $cukup ? route('investor.proposal.show', $p->id_proposal) : '#' }}"
       class="dashboard-card p-card {{ $cukup ? '' : 'p-card-off' }}"
       @if (!$cukup) tabindex="-1" aria-disabled="true" @endif>

        <div class="p-top">
            <span class="p-umkm">{{ $p->nama_usaha }}</span>
            <span class="p-bidang">{{ $p->bidang_usaha }}</span>
        </div>

        <h3 class="p-title">{{ $p->judul }}</h3>
        <p class="p-desc">{{ $p->deskripsi_inovasi }}</p>

        <div class="p-foot">
            <div>
                <div class="p-label">Dana dibutuhkan</div>
                <div class="p-dana">Rp {{ number_format($p->dana_dibutuhkan, 0, ',', '.') }}</div>
            </div>

            @if ($cukup)
                <div class="p-date">
                    {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}
                </div>
            @else
                <div class="p-warn">Dana kamu belum cukup</div>
            @endif
        </div>

    </a>
@endforeach
    </div>
@else
    <div class="dashboard-card empty-box">
        Tidak ada proposal yang cocok dengan pencarianmu.
    </div>
@endif

<div class="mt-4">
    {{ $proposals->links() }}
</div>

@endsection