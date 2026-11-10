<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InvestorAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.investor.login');
    }

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

    public function showRegister()
    {
        return view('auth.investor.register');
    }

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

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pilih');
    }
public function updateAkun(Request $request)
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
        'username' => [
            'required',
            'string',
            'max:255',
            Rule::unique('investors', 'username')
                ->ignore($investor->id_investor, 'id_investor'),
        ],
        'password_lama' => ['required', 'string'],
        'password_baru' => [
            'nullable',
            'string',
            'min:8',
            'confirmed',
        ],
    ]);
    if (!Hash::check($validated['password_lama'], $investor->password)) {
        return back()
            ->withErrors([
                'password_lama' => 'Password lama yang kamu masukkan salah.',
            ])
            ->withInput($request->only('username'));
    }
    $dataUpdate = [
        'username' => $validated['username'],
        'updated_at' => now(),
    ];

    if (!empty($validated['password_baru'])) {
        $dataUpdate['password'] = Hash::make(
            $validated['password_baru']
        );
    }
    DB::table('investors')
        ->where('id_investor', $investor->id_investor)
        ->update($dataUpdate);

    session(['auth_username' => $validated['username']]);

    return redirect()
        ->route('investor.profil')
        ->with('success_akun', 'Pengaturan akun berhasil diperbarui.');
}
}
