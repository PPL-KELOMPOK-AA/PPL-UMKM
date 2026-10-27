<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemerintahAuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.pemerintah.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $pemerintah = DB::table('pemerintah')
            ->where('username', $request->username)
            ->first();

        if (
            !$pemerintah ||
            !Hash::check($request->password, $pemerintah->password)
        ) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        $request->session()->put([
            'auth_role' => 'pemerintah',
            'auth_username' => $pemerintah->username,
        ]);

        return redirect()->route('pemerintah.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pilih');
    }
}
