<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    // Menampilkan profil UMKM
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

    // Menampilkan halaman edit profil
    public function edit()
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

        return view('umkm.profil-edit', compact('umkm'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
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

        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('umkms', 'username')
                    ->ignore($umkm->id_UMKM, 'id_UMKM'),
            ],
            'nama_usaha' => 'required|string|max:255',
            'NIB' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        DB::table('umkms')
            ->where('id_UMKM', $umkm->id_UMKM)
            ->update([
                'username' => $validated['username'],
                'nama_usaha' => $validated['nama_usaha'],
                'NIB' => $validated['NIB'],
                'bidang_usaha' => $validated['bidang_usaha'],
                'alamat' => $validated['alamat'],
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('umkm.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}