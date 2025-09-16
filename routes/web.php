<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormesController;
use App\Http\Controllers\DoseController;
use App\Models\Pharmacie;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/auth/google', [AdminController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AdminController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/pharmacies', [PharmacieController::class, 'index'])->name('pharmacies.index');
Route::post('/pharmacies', [PharmacieController::class, 'store'])->name('pharmacies.store');
Route::put('/pharmacies/{pharmacie}', [PharmacieController::class, 'update'])->name('pharmacies.update');
Route::delete('/pharmacies/{pharmacie}', [PharmacieController::class, 'destroy'])->name('pharmacies.destroy');



Route::get('/medicaments', [MedicamentController::class, 'index'])->name('medicaments.index');
Route::post('/medicaments', [MedicamentController::class, 'store'])->name('medicaments.store');
Route::put('/medicaments/{medicament}', [MedicamentController::class, 'update'])->name('medicaments.update');
Route::delete('/medicaments/{medicament}', [MedicamentController::class, 'destroy'])->name('medicaments.destroy');


Route::get('/formes', [FormesController::class, 'index'])->name('formes.index');
Route::post('/formes', [FormesController::class, 'store'])->name('formes.store');
Route::put('/formes/{formes}', [FormesController::class, 'update'])->name('formes.update');
Route::delete('/formes/{formes}', [FormesController::class, 'destroy'])->name('formes.destroy');


Route::get('/doses', [DoseController::class, 'index'])->name('doses.index');
Route::post('/doses', [DoseController::class, 'store'])->name('doses.store');

Route::put('/doses/{dose}', [DoseController::class, 'update'])->name('doses.update');

Route::delete('/doses/{dose}', [DoseController::class, 'destroy'])->name('doses.destroy');




require __DIR__ . '/auth.php';
