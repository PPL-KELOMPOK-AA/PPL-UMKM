
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

        <div class="bg-white rounded-3 border p-5 text-center">
            <i class="bi bi-handshake text-secondary"
               style="font-size: 45px;"></i>

            <h5 class="mt-3">Penawaran Investor</h5>

            <p class="text-muted mb-0">
                Halaman penawaran investor belum tersedia.
                Fitur ini akan diintegrasikan dengan halaman
                yang sedang dikembangkan oleh tim.
            </p>
        </div>

    </div>

</div>

@endsection