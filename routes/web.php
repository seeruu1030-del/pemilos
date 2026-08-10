<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateMappingController;
use App\Http\Controllers\PemilosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SelectionAnnouncementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Landing Page & Dedicated Announcement Page
Route::get('/', [SelectionAnnouncementController::class, 'home'])->name('home');
Route::get('/pengumuman', [SelectionAnnouncementController::class, 'index'])->name('pengumuman.index');
Route::post('/pengumuman/cek', [SelectionAnnouncementController::class, 'check'])->name('pengumuman.check');

// Role-aware Dashboard Redirect for Authenticated Admins
Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    if ($user && $user->isAdminPemilos()) {
        return redirect()->route('pemilos.vote');
    }
    if ($user && $user->isAdminMpk()) {
        return redirect()->route('pemilos.mpk.vote');
    }
    if ($user && $user->isAdminPenerimaan()) {
        return redirect()->route('penerimaan.index');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected Admin-01 (Pemilos OSIS E-Voting & Real Count) Routes
Route::middleware(['auth', 'role:admin-01'])->group(function () {
    Route::get('/pemilos/vote', [PemilosController::class, 'index'])->name('pemilos.vote');
    Route::post('/pemilos/vote', [PemilosController::class, 'storeVote'])->name('pemilos.storeVote');
    Route::get('/pemilos/real-count', [PemilosController::class, 'realCount'])->name('pemilos.realcount');
    Route::get('/pemilos/real-count-data', [PemilosController::class, 'realCountData'])->name('pemilos.realcount.data');
});

// Protected Admin-03 (Pemilos MPK E-Voting & Real Count) Routes
Route::middleware(['auth', 'role:admin-03'])->group(function () {
    Route::get('/pemilos-mpk/vote', [PemilosController::class, 'indexMpk'])->name('pemilos.mpk.vote');
    Route::post('/pemilos-mpk/vote', [PemilosController::class, 'storeVoteMpk'])->name('pemilos.mpk.storeVote');
    Route::get('/pemilos-mpk/real-count', [PemilosController::class, 'realCountMpk'])->name('pemilos.mpk.realcount');
    Route::get('/pemilos-mpk/real-count-data', [PemilosController::class, 'realCountDataMpk'])->name('pemilos.mpk.realcount.data');
});

// Protected Admin-02 (Penerimaan Panitia OSIS & MPK) Routes
Route::middleware(['auth', 'role:admin-02'])->group(function () {
    Route::get('/penerimaan', [CandidateController::class, 'index'])->name('penerimaan.index');
    Route::get('/penerimaan/pengaturan', [CandidateController::class, 'settings'])->name('penerimaan.settings');
    Route::post('/penerimaan/pengaturan-pengumuman', [CandidateController::class, 'updateSetting'])->name('penerimaan.updateSetting');
    Route::get('/penerimaan/calon/tambah', [CandidateController::class, 'create'])->name('penerimaan.create');
    Route::post('/penerimaan/calon', [CandidateController::class, 'store'])->name('penerimaan.store');
    Route::get('/penerimaan/calon/{candidate}/edit', [CandidateController::class, 'edit'])->name('penerimaan.edit');
    Route::put('/penerimaan/calon/{candidate}', [CandidateController::class, 'update'])->name('penerimaan.update');
    Route::patch('/penerimaan/calon/{candidate}/status', [CandidateController::class, 'updateStatus'])->name('penerimaan.updateStatus');
    Route::delete('/penerimaan/calon/{candidate}', [CandidateController::class, 'destroy'])->name('penerimaan.destroy');

    // Mapping Sub-Menu Routes for Calon OSIS & Calon MPK
    Route::get('/penerimaan/mapping/osis', [CandidateMappingController::class, 'osis'])->name('penerimaan.mapping.osis');
    Route::get('/penerimaan/mapping/mpk', [CandidateMappingController::class, 'mpk'])->name('penerimaan.mapping.mpk');
    Route::post('/penerimaan/mapping', [CandidateMappingController::class, 'store'])->name('penerimaan.mapping.store');
    Route::post('/penerimaan/mapping/{mapping}', [CandidateMappingController::class, 'update'])->name('penerimaan.mapping.update');
    Route::delete('/penerimaan/mapping/{mapping}', [CandidateMappingController::class, 'destroy'])->name('penerimaan.mapping.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Fallback route untuk rute yang tidak terdaftar
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
