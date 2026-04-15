<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModerateurController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\JoueurController;


Route::get('/', function() { return redirect()->route('accueil'); });
Route::middleware('guest.custom')->group(function () {
    Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
    Route::get('/register', [AuthController::class, 'showInscription'])->name('inscription');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showConnexion'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/terrains', function(){ return view('terrains'); })->name('terrains');
Route::get('/annonces', fn() => view('annonces'))->name('annonces');
Route::get('/annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');

Route::get('/terrains/{id}', [TerrainController::class, 'show'])->name('terrains.show');

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
        Route::get('/mesterrains', [ModerateurController::class, 'index'])
            ->name('moderateur.mesterrains.index');
    });

    Route::middleware('isJoueur')->prefix('joueur')->group(function () {
        Route::get('/dashboard', [JoueurController::class, 'dashboard'])
            ->name('joueur.dashboard');
        Route::get('/reservations', [JoueurController::class, 'reservations'])
            ->name('joueur.reservations');
        Route::get('/participations', [JoueurController::class, 'participations'])
            ->name('joueur.participations');
        Route::get('/points', [JoueurController::class, 'points'])
            ->name('joueur.points');
        Route::get('/historique', [JoueurController::class, 'historique'])
            ->name('joueur.historique');
        Route::get('/notifications', [JoueurController::class, 'notifications'])
            ->name('joueur.notifications');
    });

});

