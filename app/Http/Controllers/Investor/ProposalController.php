<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $danaInvestor = DB::table('investors')
        ->where('id_investor', session('auth_id'))
        ->value('dana_tersedia');

        //proposal + data UMKM pling murah
        $query = Proposal::join('umkms', 'proposals.id_UMKM', '=', 'umkms.id_UMKM')
            ->select('proposals.*', 'umkms.nama_usaha', 'umkms.bidang_usaha');

        $query->orderBy('proposals.dana_dibutuhkan', 'asc');

        $bidangList = Proposal::join('umkms', 'proposals.id_UMKM', '=', 'umkms.id_UMKM')
            ->distinct()
            ->pluck('umkms.bidang_usaha');

        //filt    
        if ($request->filled('q')) {
            $query->where('proposals.judul', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('bidang')) {
            $query->where('umkms.bidang_usaha', $request->bidang);
        }
        $proposals = $query->paginate(10)->withQueryString();
       
        return view('investor.proposal.index', compact('proposals', 'bidangList', 'danaInvestor'));
    }

    public function show($id)
    {
        $danaInvestor = DB::table('investors')
        ->where('id_investor', session('auth_id'))
        ->value('dana_tersedia');

        $proposal = Proposal::join('umkms', 'proposals.id_UMKM', '=', 'umkms.id_UMKM')
            ->select('proposals.*', 'umkms.nama_usaha', 'umkms.bidang_usaha', 'umkms.alamat')
            ->where('proposals.id_proposal', $id)
            ->firstOrFail();

        return view('investor.proposal.show', compact('proposal', 'danaInvestor'));
    }
}