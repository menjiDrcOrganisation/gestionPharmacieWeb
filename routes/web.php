<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormesController;
use App\Http\Controllers\doseController;
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
Route::get('/medicaments', [MedicamentController::class, 'index'])->name('medicaments.index');

Route::get('/formes', [FormesController::class, 'index'])->name('formes.index');
Route::get('/doses', [doseController::class, 'index'])->name('doses.index');

Route::post('/pharmacies', [PharmacieController::class, 'store'])->name('pharmacies.store');
require __DIR__ . '/auth.php';
