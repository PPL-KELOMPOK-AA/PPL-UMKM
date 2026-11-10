<?php

namespace App\Http\Controllers\Pemerintah;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Menampilkan daftar profil investor yang perlu diverifikasi oleh pemerintah.
     */
    public function indexInvestor()
    {
        $investors = Investor::orderBy('id_investor', 'desc')->get();

        $totalInvestor = $investors->count();
        $menungguCount = $investors->where('status_verifikasi', 'Menunggu')->count();
        $terverifikasiCount = $investors->where('status_verifikasi', 'Terverifikasi')->count();
        $ditolakCount = $investors->where('status_verifikasi', 'Ditolak')->count();

        return view('pemerintah.verifikasi.index', compact(
            'investors',
            'totalInvestor',
            'menungguCount',
            'terverifikasiCount',
            'ditolakCount'
        ));
    }

    /**
     * Menampilkan detail profil dan dokumen investor untuk peninjauan.
     */
    public function showInvestor($id)
    {
        $investor = Investor::findOrFail($id);

        return view('pemerintah.verifikasi.show', compact('investor'));
    }

    /**
     * Memproses aksi persetujuan atau penolakan verifikasi profil investor.
     * Sesuai method verifikasiProfilInvestor pada Class Diagram Pemerintah.
     */
    public function verifikasiInvestor(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Terverifikasi,Ditolak,Menunggu',
            'catatan'           => 'nullable|string|max:500',
        ]);

        $investor = Investor::findOrFail($id);
        $investor->status_verifikasi = $request->status_verifikasi;
        $investor->save();

        $pesan = $request->status_verifikasi === 'Terverifikasi'
            ? 'Profil investor "' . $investor->nama_investor . '" berhasil disetujui (Terverifikasi).'
            : ($request->status_verifikasi === 'Ditolak'
                ? 'Profil investor "' . $investor->nama_investor . '" telah ditolak.'
                : 'Status verifikasi investor "' . $investor->nama_investor . '" dikembalikan ke Menunggu.');

        return redirect()->route('pemerintah.verifikasi.investor.index')
            ->with('success', $pesan);
    }
}
