<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function create()
    {
        return view('proposals.create');
    }

    public function ajukanProposal(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi_inovasi' => 'required|string',
            'dana_dibutuhkan'   => 'required|numeric|min:1000',
            'file_proposal'     => 'required|file|mimes:pdf,docx|max:10240', // Maksimal file 10MB
        ]);

        $filePath = $request->file('file_proposal')->store('proposals', 'public');

    
        Proposal::create([
            'id_UMKM'           => 1,
            'judul'             => $request->judul,
            'deskripsi_inovasi' => $request->deskripsi_inovasi,
            'dana_dibutuhkan'   => $request->dana_dibutuhkan,
            'tanggal_pengajuan' => now()->toDateString(), 
            'file_proposal'     => $filePath,
        ]);

        return redirect()->back()->with('success', 'Proposal proyek berhasil diajukan!');
    }
}