<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\GerantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoseController;
use App\Http\Controllers\FormesController;
use App\Http\Controllers\MedicamentController;






Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/auth/google', [AdminController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AdminController::class, 'handleGoogleCallback'])->name('google.callback');


// Ressource complète pour CRUD Gérants
Route::resource('gerants', GerantController::class);

// Ressource complète pour CRUD Doses
Route::resource('doses', DoseController::class);

// Ressource complète pour CRUD Formes
Route::resource('formes', FormesController::class);

// Ressource complète pour CRUD Médicaments
Route::resource('medicaments', MedicamentController::class);

// Ressource complète pour CRUD Pharmacies
Route::resource('pharmacies', PharmacieController::class);

// Mise à jour statut
Route::patch('/pharmacies/{id}/statut', [PharmacieController::class, 'updateStatut'])->name('pharmacies.updateStatut');





require __DIR__.'/auth.php';
