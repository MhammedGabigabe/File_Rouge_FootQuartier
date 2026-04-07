<?php

use Illuminate\Support\Facades\Route;

Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');

Route::get('/inscription', function(){
    return view('inscription');
})->name('inscription');

Route::get('/connexion', function(){
    return view('connexion');
})->name('connexion');

Route::get('/terrains', function(){
    return view('terrains');
})->name('terrains');
