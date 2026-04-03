<?php

use Illuminate\Support\Facades\Route;

Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');

Route::get('/inscription', function(){
    return view('inscription');
})->name('inscription');

