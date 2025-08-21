<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VenteController;

Route::prefix('pharmacie/{id_pharmacie}/vente')->name('ventes.')->group(function () {
    Route::get('/', [VenteController::class, 'index'])->name('index'); 
    Route::get('/{id_vente}', [VenteController::class, 'show'])->name('show'); 
    Route::post('/', [VenteController::class, 'store'])->name('store'); 
    Route::put('/{id_vente}', [VenteController::class, 'update'])->name('update'); 
    Route::delete('/{id_vente}', [VenteController::class, 'destroy'])->name('destroy'); 
});
