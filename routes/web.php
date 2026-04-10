<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/adminDashboard', function () {
    return view('adminDashboard');
})->middleware(['auth', 'isAdmin'])->name('admin.dashboard');

Route::get('/login', function () {
    return redirect()->route('connexion');
})->name('login');

Route::get('/terrains', function(){ return view('terrains'); })->name('terrains');


