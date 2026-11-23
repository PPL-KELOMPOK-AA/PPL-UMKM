<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\PenawaranPendanaan;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenawaranController extends Controller
{
public function create($id)
{
    if (session('auth_role') !== 'investor') {
        return redirect()->route('login.pilih');
    }

    $proposal = DB::table('proposals')
        ->join('umkms', 'umkms.id_UMKM', '=', 'proposals.id_UMKM')
        ->select('proposals.*', 'umkms.nama_usaha', 'umkms.bidang_usaha')
        ->where('proposals.id_proposal', $id)
        ->first();

    abort_if(!$proposal, 404);

    $danaInvestor = DB::table('investors')
        ->where('id_investor', session('auth_id'))
        ->value('dana_tersedia');

    if ($danaInvestor < $proposal->dana_dibutuhkan) {
        return redirect()->route('investor.proposal')
            ->with('error', 'Dana tersedia kamu belum cukup untuk proposal ini.');
    }

    $sudahMengajukan = PenawaranPendanaan::where('id_proposal', $id)
        ->where('id_investor', session('auth_id'))
        ->exists();

    if ($sudahMengajukan) {
        return redirect()->route('investor.penawaran.index')
            ->with('error', 'Kamu sudah mengajukan penawaran untuk proposal ini.');
    }

    return view('investor.penawaran.create', compact('proposal', 'danaInvestor'));
}

public function store(Request $request, $id)
{
    if (session('auth_role') !== 'investor') {
        return redirect()->route('login.pilih');
    }

    $proposal = Proposal::findOrFail($id);

    $danaInvestor = DB::table('investors')
        ->where('id_investor', session('auth_id'))
        ->value('dana_tersedia');

    $request->validate([
        'jumlah_dana' => 'required|numeric|min:1|max:' . $danaInvestor,
        'persyaratan' => 'required|string|max:255',
    ], [
        'jumlah_dana.max' => 'Jumlah dana melebihi dana tersedia kamu.',
    ]);

    $sudahMengajukan = PenawaranPendanaan::where('id_proposal', $proposal->id_proposal)
        ->where('id_investor', session('auth_id'))
        ->exists();

    if ($sudahMengajukan) {
        return redirect()->route('investor.penawaran.index')
            ->with('error', 'Kamu sudah mengajukan penawaran untuk proposal ini.');
    }

    PenawaranPendanaan::create([
        'jumlah_dana'       => $request->jumlah_dana,
        'persyaratan'       => $request->persyaratan,
        'tanggal_penawaran' => now()->toDateString(),
        'id_proposal'       => $proposal->id_proposal,
        'id_investor'       => session('auth_id'),
        'status'            => 'menunggu',
    ]);

    return redirect()->route('investor.penawaran.index')
        ->with('success', 'Penawaran berhasil diajukan.');
}

    // Penawaran Saya
    public function index()
    {
        if (session('auth_role') !== 'investor') {
            return redirect()->route('login.pilih');
        }

        $penawarans = PenawaranPendanaan::with('proposal.umkm')
            ->where('id_investor', session('auth_id'))
            ->orderByDesc('tanggal_penawaran')
            ->get();

        return view('investor.penawaran.index', compact('penawarans'));
    }
}