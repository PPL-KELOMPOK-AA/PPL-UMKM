<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InvestorAuthController extends Controller
{
    // Menampilkan halaman login investor
    public function showLogin()
    {
        return view('auth.investor.login');
    }

    // Memproses login investor
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $investor = DB::table('investors')
            ->where('username', $request->username)
            ->first();

        if (
            !$investor ||
            !Hash::check($request->password, $investor->password)
        ) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        $request->session()->put([
            'auth_role' => 'investor',
            'auth_id' => $investor->id_investor,
            'auth_username' => $investor->username,
        ]);

        return redirect()->route('investor.dashboard');
    }

    // Menampilkan halaman registrasi investor
    public function showRegister()
    {
        return view('auth.investor.register');
    }

    // Memproses registrasi investor
    public function register(Request $request)
    {
        $request->validate([
            'nama_investor' => ['required', 'string', 'max:255'],

            'username' => [
                'required',
                'string',
                'max:255',
                'unique:investors,username',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'jenis_investor' => [
                'required',
                Rule::in([
                    'Individu',
                    'Perusahaan',
                    'Lembaga',
                ]),
            ],
        ]);

        DB::table('investors')->insert([
            'nama_investor' => $request->nama_investor,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'dana_tersedia' => 0,
            'jenis_investor' => $request->jenis_investor,
            'status_verifikasi' => 'Menunggu Verifikasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('investor.login')
            ->with(
                'success',
                'Registrasi berhasil! Silakan login menggunakan akun investor.'
            );
    }

    // Logout investor
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pilih');
    }
}
