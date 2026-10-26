<?php

use App\Http\Controllers\ProposalController;

//rute langsung tanpa proteksi login (agar bisa dites dulu)
Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
Route::post('/proposal/ajukan', [ProposalController::class, 'ajukanProposal'])->name('proposal.ajukan');
