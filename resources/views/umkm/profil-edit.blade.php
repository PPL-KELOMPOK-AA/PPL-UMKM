@extends('layouts.umkm')

@section('title', 'Edit Profil')
@section('navbar-title', 'Edit Profil')

@section('content')

<div class="page-heading">
    <h1>Edit Profil Akun</h1>
    <p>Perbarui informasi akun dan identitas usaha kamu.</p>
</div>

<div class="dashboard-card p-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('umkm.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username"
                class="form-control"
                value="{{ old('username', $umkm->username) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Usaha</label>
            <input type="text" name="nama_usaha"
                class="form-control"
                value="{{ old('nama_usaha', $umkm->nama_usaha) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Induk Berusaha (NIB)</label>
            <input type="text" name="NIB"
                class="form-control"
                value="{{ old('NIB', $umkm->NIB) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bidang Usaha</label>
            <input type="text" name="bidang_usaha"
                class="form-control"
                value="{{ old('bidang_usaha', $umkm->bidang_usaha) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat"
                class="form-control"
                rows="3"
                required>{{ old('alamat', $umkm->alamat) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('umkm.profil') }}"
                class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>

@endsection