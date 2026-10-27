
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Auth\UmkmAuthController;
use App\Http\Controllers\Auth\InvestorAuthController;
use App\Http\Controllers\Auth\PemerintahAuthController;
use App\Http\Controllers\Investor\ProfilController;



// ========================================== HALAMAN LOGIN AREA==========================================

Route::get('/', function () {
    return view('auth.login', ['role' => 'investor']);
})->name('login.pilih');

Route::get('/login/umkm', function () {
    return view('auth.login', ['role' => 'umkm']);
})->name('umkm.login');

Route::post('/login/umkm', [UmkmAuthController::class, 'login'])
    ->name('umkm.login.process');

Route::post('/logout/umkm', [UmkmAuthController::class, 'logout'])
    ->name('umkm.logout');


Route::get('/login/investor', function () {
    return view('auth.login', ['role' => 'investor']);
})->name('investor.login');

Route::post('/login/investor', [InvestorAuthController::class, 'login'])
    ->name('investor.login.process');

Route::post('/logout/investor', [InvestorAuthController::class, 'logout'])
    ->name('investor.logout');


Route::get('/login/pemerintah', function () {
    return view('auth.login', ['role' => 'pemerintah']);
})->name('pemerintah.login');

Route::post('/login/pemerintah', [PemerintahAuthController::class, 'login'])
    ->name('pemerintah.login.process');

Route::post('/logout/pemerintah', [PemerintahAuthController::class, 'logout'])
    ->name('pemerintah.logout');

// ========================================== HALAMAN REGISTRASI AREA==========================================

Route::get('/register/umkm', [UmkmAuthController::class, 'showRegister'])
    ->name('umkm.register');

Route::post('/register/umkm', [UmkmAuthController::class, 'register'])
    ->name('umkm.register.process');


Route::get('/register/investor', [InvestorAuthController::class, 'showRegister'])
    ->name('investor.register');

Route::post('/register/investor', [InvestorAuthController::class, 'register'])
    ->name('investor.register.process');

// ========================================== HALAMAN DASHBOARD AREA==========================================

use Illuminate\Support\Facades\DB;

Route::get('/umkm/dashboard', function () {
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
})->name('umkm.dashboard');


Route::get('/investor/dashboard', function () {

    if (session('auth_role') !== 'investor') {
        return redirect()->route('login.pilih');
    }

    $investor = DB::table('investors')
        ->where('id_investor', session('auth_id'))
        ->first();

    if (!$investor) {
        return redirect()->route('login.pilih');
    }

    return view('investor.dashboard', compact('investor'));
})->name('investor.dashboard');


Route::view('/pemerintah/dashboard', 'pemerintah.dashboard')
    ->name('pemerintah.dashboard');

// ========================================== HALAMAN PROFIL AREA==========================================

Route::get('/investor/profil', [ProfilController::class,'index',])
    ->name('investor.profil');

Route::post('/investor/profil', [ProfilController::class,'update',])
    ->name('investor.profil.update');

Route::post('/investor/akun', [InvestorAuthController::class,'updateAkun',])
    ->name('investor.akun.update');

// ========================================== HALAMAN PROPOSAL AREA==========================================

Route::get('/proposal/create', [ProposalController::class, 'create'])
    ->name('proposal.create');

Route::post('/proposal/ajukan', [ProposalController::class, 'ajukanProposal'])
    ->name('proposal.ajukan');
