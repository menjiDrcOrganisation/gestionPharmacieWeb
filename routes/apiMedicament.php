<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicamentController;
use App\Http\Controllers\Api\FormeController;
use App\Http\Controllers\Api\DoseController;


Route::prefix('pharmacies/{id_pharmacie}/medicaments')->name('pharmacies.medicaments.')->group(function () {
    Route::get('/', [MedicamentController::class, 'index'])->name('index'); 
    Route::get('/{id_medicament}', [MedicamentController::class, 'show'])->name('show'); 
    Route::post('/', [MedicamentController::class, 'store'])->name('store'); 
    Route::put('/{id_medicament}', [MedicamentController::class, 'update'])->name('update'); 
    Route::delete('/{id_medicament}', [MedicamentController::class, 'destroy'])->name('destroy'); 
});



Route::prefix('forme/')->name('forme.')->group(function () {
    Route::get('/', [FormeController::class, 'index'])->name('index'); 
    Route::get('/{id_forme}', [FormeController::class, 'show'])->name('show'); 
    Route::post('/', [FormeController::class, 'store'])->name('store'); 
    Route::put('/{id_forme}', [FormeController::class, 'update'])->name('update'); 
    Route::delete('/{id_forme}', [FormeController::class, 'destroy'])->name('destroy'); 
});

Route::prefix('dose/')->name('dose.')->group(function () {
    Route::get('/', [DoseController::class, 'index'])->name('index'); 
    Route::get('/{id_dose}', [DoseController::class, 'show'])->name('show'); 
    Route::post('/', [DoseController::class, 'store'])->name('store'); 
    Route::put('/{id_dose}', [DoseController::class, 'update'])->name('update'); 
    Route::delete('/{id_dose}', [DoseController::class, 'destroy'])->name('destroy'); 
});