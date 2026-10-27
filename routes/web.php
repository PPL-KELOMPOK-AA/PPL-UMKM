
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Auth\UmkmAuthController;
use App\Http\Controllers\Auth\InvestorAuthController;
use App\Http\Controllers\Auth\PemerintahAuthController;
use App\Http\Controllers\Pemerintah\VerifikasiController;

// ==========================================
// HALAMAN LOGIN TERPADU
// ==========================================
Route::get('/', function () {
    return view('auth.login', ['role' => 'investor']);
})->name('login.pilih');

// ==========================================
// LOGIN UMKM
// ==========================================
Route::get('/login/umkm', function () {
    return view('auth.login', ['role' => 'umkm']);
})->name('umkm.login');

Route::post('/login/umkm', [UmkmAuthController::class, 'login'])
    ->name('umkm.login.process');

Route::post('/logout/umkm', [UmkmAuthController::class, 'logout'])
    ->name('umkm.logout');

// ==========================================
// LOGIN INVESTOR
// ==========================================
Route::get('/login/investor', function () {
    return view('auth.login', ['role' => 'investor']);
})->name('investor.login');

Route::post('/login/investor', [InvestorAuthController::class, 'login'])
    ->name('investor.login.process');

Route::post('/logout/investor', [InvestorAuthController::class, 'logout'])
    ->name('investor.logout');

// ==========================================
// LOGIN PEMERINTAH
// ==========================================
Route::get('/login/pemerintah', function () {
    return view('auth.login', ['role' => 'pemerintah']);
})->name('pemerintah.login');

Route::post('/login/pemerintah', [PemerintahAuthController::class, 'login'])
    ->name('pemerintah.login.process');

Route::post('/logout/pemerintah', [PemerintahAuthController::class, 'logout'])
    ->name('pemerintah.logout');

// ==========================================
// REGISTRASI UMKM
// ==========================================
Route::get('/register/umkm', [UmkmAuthController::class, 'showRegister'])
    ->name('umkm.register');

Route::post('/register/umkm', [UmkmAuthController::class, 'register'])
    ->name('umkm.register.process');

// ==========================================
// REGISTRASI INVESTOR
// ==========================================
Route::get('/register/investor', [InvestorAuthController::class, 'showRegister'])
    ->name('investor.register');

Route::post('/register/investor', [InvestorAuthController::class, 'register'])
    ->name('investor.register.process');

// ==========================================
// DASHBOARD
// ==========================================
Route::view('/umkm/dashboard', 'umkm.dashboard')
    ->name('umkm.dashboard');

Route::view('/investor/dashboard', 'investor.dashboard')
    ->name('investor.dashboard');

Route::view('/pemerintah/dashboard', 'pemerintah.dashboard')
    ->name('pemerintah.dashboard');

// ==========================================
// FITUR PROPOSAL - TETAP DIPERTAHANKAN
// ==========================================
Route::get('/proposal/create', [ProposalController::class, 'create'])
    ->name('proposal.create');

Route::post('/proposal/ajukan', [ProposalController::class, 'ajukanProposal'])
    ->name('proposal.ajukan');

// ==========================================
// PEMERINTAH - VERIFIKASI INVESTOR (FR-14 / SCRUM-20)
// ==========================================
Route::prefix('pemerintah')->name('pemerintah.')->group(function () {
    Route::get('/verifikasi/investor', [VerifikasiController::class, 'indexInvestor'])
        ->name('verifikasi.investor.index');
    Route::get('/verifikasi/investor/{id}', [VerifikasiController::class, 'showInvestor'])
        ->name('verifikasi.investor.show');
    Route::put('/verifikasi/investor/{id}', [VerifikasiController::class, 'verifikasiInvestor'])
        ->name('verifikasi.investor.update');
});
