@extends('layouts.investor')

@section('title', 'Detail Proposal')
@section('navbar-title', 'Detail Proposal')

@section('content')

    <style>
        .back-link {
            display: inline-block;
            margin-bottom: 14px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .back-link:hover {
            color: var(--navy);
        }


        .doc-card {
            padding: 32px 34px;
            border-radius: 14px;
        }

        .doc-meta {
            margin-bottom: 10px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .doc-meta b {
            color: var(--text-dark);
            font-weight: 600;
        }

        .doc-title {
            margin: 0 0 26px;
            color: var(--navy);
            font-size: 26px;
            font-weight: 600;
            line-height: 1.3;
        }

        .doc-section {
            padding-top: 24px;
            margin-top: 24px;
            border-top: 1px solid var(--border);
        }

        .doc-section h2 {
            margin: 0 0 10px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 600;
        }

        .doc-section p {
            margin: 0;
            color: #4a586c;
            font-size: 14px;
            line-height: 1.9;
            max-width: 720px;
        }

        .file-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fafbfd;
        }

        .file-name {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            color: var(--navy);
            font-size: 13px;
            font-weight: 600;
        }

        .file-name i {
            color: var(--blue);
            font-size: 18px;
        }

        .file-name span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-link {
            color: var(--blue);
            font-size: 13px;
            font-weight: 600;
        }

        .file-link:hover {
            color: var(--navy);
        }

        .side-sticky {
            position: sticky;
            top: 20px;
        }

        .side-card {
            padding: 24px;
            border-radius: 14px;
            margin-bottom: 16px;
        }

        .side-label {
            color: var(--text-muted);
            font-size: 12px;
        }

        .side-dana {
            margin: 4px 0 18px;
            color: var(--navy);
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .side-note {
            margin: 12px 0 0;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.6;
            text-align: center;
        }

        .side-title {
            margin: 0 0 6px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
        }

        .info-row {
            padding: 11px 0;
            border-top: 1px solid var(--border);
        }

        .info-row:first-of-type {
            border-top: 0;
        }

        .info-row .k {
            color: var(--text-muted);
            font-size: 12px;
        }

        .info-row .v {
            margin-top: 2px;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 600;
        }

        .btn-off {
            background: #c5cdd9;
            color: #fff;
            cursor: not-allowed;
        }

        .btn-off:hover {
            background: #c5cdd9;
        }

        .side-warn {
            margin: 12px 0 0;
            color: #bc2c2c;
            font-size: 12px;
            line-height: 1.6;
            text-align: center;
        }

        @media (max-width: 991px) {
            .side-sticky {
                position: static;
            }

            .doc-card {
                padding: 24px 22px;
            }

            .doc-title {
                font-size: 22px;
            }
        }
    </style>

    <a href="{{ route('investor.proposal') }}" class="back-link">&larr; Kembali ke daftar</a>

    <div class="row g-3">

        {{-- KIRI --}}
        <div class="col-lg-8">
            <div class="dashboard-card doc-card">

                <div class="doc-meta">
                    <b>{{ $proposal->nama_usaha }}</b>
                    &nbsp;di bidang {{ $proposal->bidang_usaha }}
                </div>

                <h1 class="doc-title">{{ $proposal->judul }}</h1>

                <div class="doc-section" style="margin-top: 0;">
                    <h2>Deskripsi inovasi</h2>
                    <p>{{ $proposal->deskripsi_inovasi }}</p>
                </div>

                <div class="doc-section">
                    <h2>Dokumen proposal</h2>
                    <div class="file-row">
                        <div class="file-name">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>{{ basename($proposal->file_proposal) }}</span>
                        </div>
                        <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank" class="file-link">
                            Buka file
                        </a>
                    </div>
                </div>

            </div>
        </div>

             {{-- KANAN --}}
        <div class="col-lg-4">
            <div class="side-sticky">

                <div class="dashboard-card side-card">
                    <div class="side-label">Dana dibutuhkan</div>
                    <div class="side-dana">Rp {{ number_format($proposal->dana_dibutuhkan, 0, ',', '.') }}</div>

                    @php $cukup = $danaInvestor >= $proposal->dana_dibutuhkan; @endphp

                    @if ($cukup)
                        <a href="#" class="btn-dashboard w-100">Ajukan penawaran</a>
                    @else
                        <button type="button" class="btn-dashboard btn-off w-100" disabled>Ajukan penawaran</button>
                        <p class="side-warn">
                            Dana tersedia kamu Rp {{ number_format($danaInvestor, 0, ',', '.') }}, belum cukup untuk
                            proposal ini.
                        </p>
                    @endif
                </div>

                <div class="dashboard-card side-card">
                    <h3 class="side-title">Profil UMKM</h3>
                    <div class="info-row">
                        <div class="k">Nama usaha</div>
                        <div class="v">{{ $proposal->nama_usaha }}</div>
                    </div>
                    <div class="info-row">
                        <div class="k">Bidang usaha</div>
                        <div class="v">{{ $proposal->bidang_usaha }}</div>
                    </div>
                    <div class="info-row">
                        <div class="k">Alamat</div>
                        <div class="v">{{ $proposal->alamat }}</div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
