<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InovasiController extends Controller
{
    // Menampilkan daftar inovasi milik UMKM yang sedang login
    public function index()
    {
        if (session('auth_role') !== 'umkm') {
            return redirect()->route('login.pilih');
        }

        $umkm = DB::table('umkms')
            ->where('id_UMKM', session('auth_id'))
            ->first();

        if (!$umkm) {
            return redirect()->route('login.pilih');
        }

        $inovasis = DB::table('inovasis')
            ->where('id_UMKM', session('auth_id'))
            ->get();

        return view('umkm.inovasi.index', compact('umkm', 'inovasis'));
    }
}