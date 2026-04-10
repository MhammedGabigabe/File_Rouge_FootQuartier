<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('/inscription', [AuthController::class, 'showInscription'])->name('inscription');
    Route::post('/inscription', [AuthController::class, 'register']);

    Route::get('/connexion', [AuthController::class, 'showConnexion'])->name('connexion');
    Route::post('/connexion', [AuthController::class, 'login']);
});

Route::get('/accueil', function () { return view('accueil'); })->name('accueil');

Route::get('/attente-approbation', [AuthController::class, 'showAttente'])
    ->name('attente.approbation')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/adminDashboard', [AdminController::class, 'dashboard'])
//     ->middleware(['auth', 'isAdmin'])->name('admin.dashboard');


Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/adminDashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.user.toggle');
    Route::post('/user/{id}/approve', [AdminController::class, 'approve'])->name('admin.user.approve');
});


Route::get('/login', function () {
    return redirect()->route('connexion');
})->name('login');

Route::get('/terrains', function(){ return view('terrains'); })->name('terrains');


