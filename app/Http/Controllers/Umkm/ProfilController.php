<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
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

        return view('umkm.profil', compact('umkm'));
    }
}
