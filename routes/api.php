<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicamentController;


Route::prefix('pharmacies/{id_pharmacie}/medicaments')->name('pharmacies.medicaments.')->group(function () {
    Route::get('/', [MedicamentController::class, 'index'])->name('index'); 
    Route::get('/{id_medicament}', [MedicamentController::class, 'show'])->name('show'); 
    Route::post('/', [MedicamentController::class, 'store'])->name('store'); 
    Route::put('/{id_medicament}', [MedicamentController::class, 'update'])->name('update'); 
    Route::delete('/{id_medicament}', [MedicamentController::class, 'destroy'])->name('destroy'); 
});
require __DIR__.'/apiAuth.php';



// ->middleware('auth:sanctum');
// Route
