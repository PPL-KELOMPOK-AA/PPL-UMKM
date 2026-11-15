<?php

namespace App\Http\Controllers\Pemerintah;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class VerifikasiUmkmController extends Controller
{
    /**
     * Menampilkan daftar profil UMKM yang perlu diverifikasi oleh pemerintah.
     * Sesuai FR-13: Memverifikasi UMKM.
     */
    public function index()
    {
        $umkms = Umkm::orderBy('id_umkm', 'desc')->get();

        $totalUmkm = $umkms->count();
        $menungguCount = $umkms->where('status_verifikasi', 'Menunggu')->count();
        $terverifikasiCount = $umkms->where('status_verifikasi', 'Terverifikasi')->count();
        $ditolakCount = $umkms->where('status_verifikasi', 'Ditolak')->count();

        return view('pemerintah.verifikasi.umkm_index', compact(
            'umkms',
            'totalUmkm',
            'menungguCount',
            'terverifikasiCount',
            'ditolakCount'
        ));
    }

    /**
     * Menampilkan detail profil dan dokumen legalitas UMKM untuk peninjauan.
     */
    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);

        return view('pemerintah.verifikasi.umkm_show', compact('umkm'));
    }

    /**
     * Memproses aksi persetujuan atau penolakan verifikasi profil UMKM.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Terverifikasi,Ditolak,Menunggu',
            'catatan_verifikasi' => 'nullable|string|max:500',
        ]);

        $umkm = Umkm::findOrFail($id);
        $umkm->status_verifikasi = $request->status_verifikasi;
        
        // Simpan catatan jika kolomnya tersedia di database
        if (Schema::hasColumn('umkm', 'catatan_verifikasi')) {
            $umkm->catatan_verifikasi = $request->catatan_verifikasi;
        }
        
        $umkm->save();

        $pesan = $request->status_verifikasi === 'Terverifikasi'
            ? 'Profil UMKM "' . $umkm->nama_usaha . '" berhasil disetujui (Terverifikasi).'
            : ($request->status_verifikasi === 'Ditolak'
                ? 'Profil UMKM "' . $umkm->nama_usaha . '" telah ditolak.'
                : 'Status verifikasi UMKM "' . $umkm->nama_usaha . '" dikembalikan ke Menunggu.');

        return redirect()->route('pemerintah.umkm.index')
            ->with('success', $pesan);
    }
}