<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InovasiController extends Controller
{
    public function index()
    {
        if (session('auth_role') !== 'umkm') {
            return redirect()->route('login.pilih');
        }

        $idUmkm = session('auth_id');

        $umkm = DB::table('umkms')
            ->where('id_UMKM', $idUmkm)
            ->first();

        if (!$umkm) {
            return redirect()->route('login.pilih');
        }

        $inovasis = DB::table('inovasis')
            ->where('id_UMKM', $idUmkm)
            ->get();

        $proposals = DB::table('proposals')
            ->where('proposals.id_UMKM', $idUmkm)
            ->select('proposals.*')
            ->selectSub(function ($query) {
                $query->from('penawaran_pendanaans')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn(
                        'penawaran_pendanaans.id_proposal',
                        'proposals.id_proposal'
                    );
            }, 'jumlah_penawaran')
            ->get();

        $penawarans = DB::table('penawaran_pendanaans')
            ->join(
                'investors',
                'penawaran_pendanaans.id_investor',
                '=',
                'investors.id_investor'
            )
            ->join(
                'proposals',
                'penawaran_pendanaans.id_proposal',
                '=',
                'proposals.id_proposal'
            )
            ->where('proposals.id_UMKM', $idUmkm)
            ->select(
                'penawaran_pendanaans.*',
                'investors.nama_investor'
            )
            ->orderBy('penawaran_pendanaans.tanggal_penawaran', 'desc')
            ->get()
            ->groupBy('id_proposal');

        return view('umkm.inovasi.index', compact(
            'umkm',
            'inovasis',
            'proposals',
            'penawarans'
        ));
    }
}