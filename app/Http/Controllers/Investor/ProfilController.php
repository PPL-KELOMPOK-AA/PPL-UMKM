<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index()
    {
        if (session('auth_role') !== 'investor') {
            return redirect()->route('login.pilih');
        }

        $investor = DB::table('investors')
            ->where('id_investor', session('auth_id'))
            ->first();

        if (!$investor) {
            return redirect()->route('login.pilih');
        }

        return view('investor.profil', compact('investor'));
    }

    public function update(Request $request)
    {
        if (session('auth_role') !== 'investor') {
            return redirect()->route('login.pilih');
        }

        $investor = DB::table('investors')
            ->where('id_investor', session('auth_id'))
            ->first();

        if (!$investor) {
            return redirect()->route('login.pilih');
        }

        $validated = $request->validate([
            'nama_investor' => ['required', 'string', 'max:255'],
            'jenis_investor' => [
                'required',
                Rule::in(['Individu', 'Perusahaan', 'Lembaga']),
            ],
            'dana_tersedia' => ['required', 'numeric', 'min:0'],
        ]);

        $profilBerubah =
            $investor->nama_investor !== $validated['nama_investor'] ||
            $investor->jenis_investor !== $validated['jenis_investor'] ||
            (float) $investor->dana_tersedia !==
                (float) $validated['dana_tersedia'];

        $dataUpdate = [
            'nama_investor' => $validated['nama_investor'],
            'jenis_investor' => $validated['jenis_investor'],
            'dana_tersedia' => $validated['dana_tersedia'],
            'updated_at' => now(),
        ];

        if (
            $profilBerubah &&
            $investor->status_verifikasi === 'Terverifikasi'
        ) {
            $dataUpdate['status_verifikasi'] =
                'Menunggu Verifikasi';
        }

        DB::table('investors')
            ->where('id_investor', session('auth_id'))
            ->update($dataUpdate);

        return redirect()
            ->route('investor.profil')
            ->with(
                'success_profil',
                'Profil investasi berhasil diperbarui.'
            );
    }
}
