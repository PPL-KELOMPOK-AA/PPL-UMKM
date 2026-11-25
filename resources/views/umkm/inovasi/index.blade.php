
@extends('layouts.umkm')

@section('title', 'Inovasi Saya')
@section('navbar-title', 'Inovasi Saya')

@section('content')

<div class="page-heading">
    <h1>Inovasi Saya</h1>
    <p>Kelola portofolio inovasi dan pantau penawaran dari investor.</p>
</div>

{{-- TAB NAVIGASI --}}
<ul class="nav nav-tabs mb-4" id="inovasiTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="katalog-tab"
                data-bs-toggle="tab"
                data-bs-target="#katalog"
                type="button"
                role="tab">
            <i class="bi bi-lightbulb"></i>
            Katalog Inovasi
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="penawaran-tab"
                data-bs-toggle="tab"
                data-bs-target="#penawaran"
                type="button"
                role="tab">
            <i class="bi bi-handshake"></i>
            Penawaran Investor
        </button>
    </li>

</ul>

{{-- ISI TAB --}}
<div class="tab-content" id="inovasiTabContent">

    {{-- TAB KATALOG INOVASI --}}
    <div class="tab-pane fade show active"
         id="katalog"
         role="tabpanel">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-semibold mb-1">Portofolio Inovasi</h5>
                <p class="text-muted small mb-0">
                    {{ $inovasis->count() }} inovasi terdaftar
                </p>
            </div>

            <a href="#" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Portofolio
            </a>
        </div>

        <div class="row g-4">

            @forelse ($inovasis as $inovasi)

                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm">

                        @if ($inovasi->gambar)
                            <img
                                src="{{ asset('storage/' . $inovasi->gambar) }}"
                                class="card-img-top"
                                alt="{{ $inovasi->nama_inovasi }}"
                                style="height: 200px; object-fit: cover;"
                            >
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <i class="bi bi-image text-secondary"
                                   style="font-size: 45px;"></i>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-light text-primary">
                                    {{ $inovasi->kategori }}
                                </span>

                                <span class="badge
                                    {{ $inovasi->status == 'Selesai' ? 'bg-success' : ($inovasi->status == 'Berjalan' ? 'bg-primary' : 'bg-warning text-dark') }}">
                                    {{ $inovasi->status }}
                                </span>
                            </div>

                            <h5 class="card-title fw-semibold">
                                {{ $inovasi->nama_inovasi }}
                            </h5>

                            <p class="card-text text-muted small">
                                {{ $inovasi->deskripsi }}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-0 pt-0 pb-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary" disabled>
                                    Edit
                                </button>

                                <button class="btn btn-sm btn-outline-danger" disabled>
                                    Hapus
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <div class="bg-white rounded-3 border p-5 text-center">
                        <i class="bi bi-folder2-open text-secondary"
                           style="font-size: 45px;"></i>

                        <h5 class="mt-3">Belum Ada Inovasi</h5>

                        <p class="text-muted mb-0">
                            Portofolio inovasimu belum tersedia.
                            Mulai dokumentasikan inovasi yang telah kamu kembangkan.
                        </p>
                    </div>
                </div>

            @endforelse

        </div>

    </div>

    {{-- TAB PENAWARAN INVESTOR --}}
<div class="tab-pane fade"
     id="penawaran"
     role="tabpanel">

    <div class="bg-white rounded-3 border p-4">

        <h5 class="mb-3">
            <i class="bi bi-handshake me-2"></i>
            Penawaran Investor
        </h5>

        @forelse ($proposals as $proposal)

            <div class="border rounded-3 p-3 mb-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>
                        <h6 class="mb-1">
                            {{ $proposal->judul }}
                        </h6>

                        <small class="text-muted">
                            Tanggal pengajuan:
                            {{ $proposal->tanggal_pengajuan }}
                        </small>
                    </div>

                    <span class="badge bg-primary">
                        {{ $proposal->jumlah_penawaran }} Penawaran
                    </span>

                </div>

                <hr>

                <button
                    class="btn btn-outline-primary btn-sm"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#penawar-{{ $proposal->id_proposal }}">

                    <i class="bi bi-eye me-1"></i>
                    Lihat Penawar

                </button>

                <div class="collapse mt-3"
                     id="penawar-{{ $proposal->id_proposal }}">

                    @php
                        $daftarPenawar = $penawarans->get($proposal->id_proposal, collect());
                    @endphp

                    @forelse ($daftarPenawar as $penawaran)

                        <div class="border rounded-3 p-3 mb-2">

                            <h6 class="mb-2">
                                {{ $penawaran->nama_investor }}
                            </h6>

                            <p class="mb-1">
                                <strong>Jumlah dana:</strong>
                                Rp {{ number_format($penawaran->jumlah_dana, 0, ',', '.') }}
                            </p>

                            <p class="mb-1">
                                <strong>Tanggal penawaran:</strong>
                                {{ $penawaran->tanggal_penawaran }}
                            </p>

                            <p class="mb-2">
                                <strong>Persyaratan:</strong>
                                {{ $penawaran->persyaratan }}
                            </p>

                            <strong>Status:</strong>

                            @if ($penawaran->status === 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif ($penawaran->status === 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif

                        </div>

                    @empty

                        <p class="text-muted mb-0">
                            Belum ada investor yang mengajukan penawaran.
                        </p>

                    @endforelse

                </div>

            </div>

        @empty

            <div class="text-center py-5">
                <i class="bi bi-inbox text-secondary"
                   style="font-size: 45px;"></i>

                <h6 class="mt-3">Belum Ada Proposal</h6>

                <p class="text-muted mb-0">
                    Proposal yang kamu ajukan akan muncul di sini
                    ketika tersedia.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection