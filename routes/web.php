<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TravailController;

Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher la page d'accueil du tableau de bord
Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour la recherche
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Route pour la section informatique
Route::get('/informatique', function () {
    return view('informatique');
});

// Routes pour les annonces de travail
Route::get('/travail/create', [TravailController::class, 'create'])->name('travail.create');
Route::post('/travail/store', [TravailController::class, 'store'])->name('travail.store');

// Route pour afficher les annonces pour Développeur web
Route::get('/informatique/developpeur-web', [TravailController::class, 'devWeb'])->name('informatique.developperweb');

Route::get('/informatique/vente-pc-gamer', [TravailController::class, 'pcGamer'])->name('informatique.ventepcgamer');


// Autres pages pour d'autres postes
Route::get('/informatique/administrateur-reseau', function () {
    return view('informatique.administrateurreaseau');
});

Route::get('/informatique/analyste-donnees', function () {
    return view('informatique.analystedonnees');
});

// Inclure le fichier d'authentification
require __DIR__.'/auth.php';
