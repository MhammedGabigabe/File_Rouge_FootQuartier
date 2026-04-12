<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModerateurController;


Route::get('/accueil', function () { return view('accueil'); })->name('accueil');
Route::get('/', fn() => redirect()->route('accueil'));
Route::get('/terrains', function(){ return view('terrains'); })->name('terrains');

Route::get('/login', function () { return redirect()->route('connexion'); })->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/inscription', [AuthController::class, 'showInscription'])->name('inscription');
    Route::post('/inscription', [AuthController::class, 'register']);

    Route::get('/connexion', [AuthController::class, 'showConnexion'])->name('connexion');
    Route::post('/connexion', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/attente-approbation', [AuthController::class, 'showAttente'])
        ->name('attente.approbation');

    Route::middleware('isAdmin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::get('/search', [AdminController::class, 'search'])
            ->name('admin.user.search');
        Route::post('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])
            ->name('admin.user.toggle');
        Route::post('/user/{id}/approve', [AdminController::class, 'approve'])
            ->name('admin.user.approve');
    });    

    Route::middleware('isModerateur')->prefix('moderateur')->group(function () {
        Route::get('/dashboard', [ModerateurController::class, 'dashboard'])
            ->name('moderator.dashboard');
    });
});
