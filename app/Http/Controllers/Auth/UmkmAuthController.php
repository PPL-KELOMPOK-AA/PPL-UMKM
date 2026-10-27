<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UmkmAuthController extends Controller
{
     public function showLogin()
    {
        return view('auth.umkm.login');
    }

    // Memproses login UMKM
    public function login(Request $request)
    {
        // 1. Memeriksa input dari form
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Mencari akun UMKM berdasarkan username
        $umkm = DB::table('umkms')
            ->where('username', $request->username)
            ->first();

        // 3. Memeriksa akun dan password
        if (!$umkm || !Hash::check($request->password, $umkm->password)) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->onlyInput('username');
        }

        // 4. Membuat session login
        $request->session()->regenerate();

        $request->session()->put([
            'auth_role' => 'umkm',
            'auth_id' => $umkm->id_UMKM,
            'auth_username' => $umkm->username,
        ]);

        // 5. Mengarahkan pengguna ke dashboard UMKM
        return redirect()->route('umkm.dashboard');
    }

    // Logout UMKM
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pilih');
    }


    // Menampilkan halaman registrasi UMKM
    public function showRegister()
    {
        return view('auth.umkm.register');
    }

    // Memproses registrasi UMKM
    public function register(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:umkms,username',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'NIB' => ['required', 'string', 'max:255'],
            'bidang_usaha' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        DB::table('umkms')->insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_usaha' => $request->nama_usaha,
            'NIB' => $request->NIB,
            'bidang_usaha' => $request->bidang_usaha,
            'alamat' => $request->alamat,
            'status_verifikasi' => 'Menunggu Verifikasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('umkm.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

}
