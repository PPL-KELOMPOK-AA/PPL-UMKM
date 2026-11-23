
<?php

use App\Http\Controllers\Auth\InvestorAuthController;
use App\Http\Controllers\Auth\PemerintahAuthController;
use App\Http\Controllers\Auth\UmkmAuthController;
use App\Http\Controllers\Investor\PenawaranController as InvestorPenawaranController;
use App\Http\Controllers\Investor\ProfilController;
use App\Http\Controllers\Investor\ProposalController as InvestorProposalController;
use App\Http\Controllers\Pemerintah\VerifikasiController;
use App\Http\Controllers\Umkm\ProfilController as UmkmProfilController;
use App\Http\Controllers\Umkm\ProposalController as UmkmProposalController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ========================================== HALAMAN LOGIN ==========================================

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

// ========================================== HALAMAN REGISTRASI ==========================================

Route::get('/register/umkm', [UmkmAuthController::class, 'showRegister'])
    ->name('umkm.register');

Route::post('/register/umkm', [UmkmAuthController::class, 'register'])
    ->name('umkm.register.process');

Route::get('/register/investor', [InvestorAuthController::class, 'showRegister'])
    ->name('investor.register');

Route::post('/register/investor', [InvestorAuthController::class, 'register'])
    ->name('investor.register.process');

// ========================================== DASHBOARD ==========================================

Route::get('/umkm/dashboard', function () {
    if (session('auth_role') !== 'umkm') {
        return redirect()->route('login.pilih');
    }

    $umkm = DB::table('umkms')
        ->where('id_UMKM', session('auth_id'))
        ->first();

    if (! $umkm) {
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

    if (! $investor) {
        return redirect()->route('login.pilih');
    }

    return view('investor.dashboard', compact('investor'));
})->name('investor.dashboard');

Route::view('/pemerintah/dashboard', 'pemerintah.dashboard')
    ->name('pemerintah.dashboard');

// ========================================== PROFIL ==========================================

Route::get('/investor/profil', [ProfilController::class, 'index'])
    ->name('investor.profil');

Route::post('/investor/profil', [ProfilController::class, 'update'])
    ->name('investor.profil.update');

Route::post('/investor/akun', [InvestorAuthController::class, 'updateAkun'])
    ->name('investor.akun.update');

Route::get('/umkm/profil', [UmkmProfilController::class, 'index'])
    ->name('umkm.profil');

Route::get('/umkm/profil/edit', [UmkmProfilController::class, 'edit'])
    ->name('umkm.profil.edit');

Route::put('/umkm/profil/update', [UmkmProfilController::class, 'update'])
    ->name('umkm.profil.update');

// ========================================== PROPOSAL UMKM ==========================================

// ========================================== PROPOSAL UMKM ==========================================

// ========================================== PROPOSAL UMKM ==========================================

Route::prefix('umkm')->name('umkm.')->group(function () {

    Route::get('/proposal/create', [UmkmProposalController::class, 'create'])
        ->name('proposal.create');

    Route::post('/proposal/ajukan', [UmkmProposalController::class, 'ajukanProposal'])
        ->name('proposal.ajukan');

});

// ========================================== PROPOSAL INVESTOR ==========================================

Route::prefix('investor')->name('investor.')->group(function () {

    Route::get('/proposal', [InvestorProposalController::class, 'index'])
        ->name('proposal');

    Route::get('/proposal/{id}', [InvestorProposalController::class, 'show'])
        ->whereNumber('id')
        ->name('proposal.show');

    Route::get('/proposal/create', [InvestorProposalController::class, 'create'])
        ->name('proposal.create');

    Route::post('/proposal/ajukan', [InvestorProposalController::class, 'ajukanProposal'])
        ->name('proposal.ajukan');
    Route::get('/proposal/{id}/penawaran', [InvestorPenawaranController::class, 'create'])
        ->name('penawaran.create');

    Route::post('/proposal/{id}/penawaran', [InvestorPenawaranController::class, 'store'])
        ->name('penawaran.store');

    Route::get('/penawaran', [InvestorPenawaranController::class, 'index'])
        ->name('penawaran.index');
});

// ========================================== VERIFIKASI INVESTOR ==========================================

Route::prefix('pemerintah')->name('pemerintah.')->group(function () {

    Route::get('/verifikasi/investor', [VerifikasiController::class, 'indexInvestor'])
        ->name('verifikasi.investor.index');

    Route::get('/verifikasi/investor/{id}', [VerifikasiController::class, 'showInvestor'])
        ->name('verifikasi.investor.show');

    Route::put('/verifikasi/investor/{id}', [VerifikasiController::class, 'verifikasiInvestor'])
        ->name('verifikasi.investor.update');

});
