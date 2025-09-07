<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PharmacieController;


Route::prefix('pharmacies')->name('pharmacies.')->group(function () {
    Route::get('/gerant/{id_gerant}', [PharmacieController::class, 'pharmaciesDuGerant'])
    ->name('gerant.pharmacies');
    
        Route::get('/', [PharmacieController::class, 'index'])->name('index'); 
    Route::post('/', [PharmacieController::class, 'store'])->name('store'); 
    Route::get('/{id_pharmacie}', [PharmacieController::class, 'show'])->name('show'); 
    Route::put('/{id_pharmacie}', [PharmacieController::class, 'update'])->name('update'); 
    Route::delete('/{id_pharmacie}', [PharmacieController::class, 'destroy'])->name('destroy'); 
});