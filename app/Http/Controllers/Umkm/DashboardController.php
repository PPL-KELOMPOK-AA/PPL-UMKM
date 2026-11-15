<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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

        return view('umkm.dashboard', compact('umkm'));
    }
}
