<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;


class ProposalController extends Controller
{
    public function create()
    {
        return view('umkm.proposal.create');
    }

    public function ajukanProposal(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi_inovasi' => 'required|string',
            'dana_dibutuhkan'   => 'required|numeric|min:1000',
            'file_proposal'     => 'required|file|mimes:pdf,docx|max:10240', // Maksimal file 10MB
        ], [
            'file_proposal.required' => 'Dokumen proposal wajib diunggah.',
            'file_proposal.file'     => 'Berkas yang diunggah tidak valid.',
            'file_proposal.mimes'    => 'Format dokumen harus berupa berkas PDF (.pdf) atau Word (.docx).',
            'file_proposal.max'      => 'Ukuran dokumen proposal melebihi batas maksimal 10 MB. Berkas ditolak.',
            'judul.required'         => 'Judul proyek inovasi wajib diisi.',
            'deskripsi_inovasi.required' => 'Deskripsi inovasi wajib diisi.',
            'dana_dibutuhkan.required'   => 'Target dana yang dibutuhkan wajib diisi.',
            'dana_dibutuhkan.min'        => 'Target dana minimal adalah Rp 1.000.',
        ]);

        $filePath = $request->file('file_proposal')->store('proposals', 'public');

        Proposal::create([
            'id_UMKM'           => session('auth_id') ?? 1,
            'judul'             => $request->judul,
            'deskripsi_inovasi' => $request->deskripsi_inovasi,
            'dana_dibutuhkan'   => $request->dana_dibutuhkan,
            'tanggal_pengajuan' => now()->toDateString(),
            'file_proposal'     => $filePath,
        ]);

        return redirect()->back()->with('success', 'Proposal proyek berhasil diajukan!');
    }
}
