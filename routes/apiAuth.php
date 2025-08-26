<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoseController;


Route::post('/google-login', [AuthController::class, 'googleLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'registerusers']);
Route::get('/users', [AuthController::class, 'show']);
Route::Post('/pharmacies', [AuthController::class, 'pharmacie']);
Route::Post('/registerVendeur', [AuthController::class, 'registerVendeur']);

//lots
Route::post('/lots/{id_pharmacie}/medicament', [App\Http\Controllers\Api\LotController::class, 'getlostmedicament']);
Route::post('/lots', [App\Http\Controllers\Api\LotController::class, 'store']);
Route::get('/lots', [App\Http\Controllers\Api\LotController::class, 'index']);
Route::post('/lots/{id}/prixunitaire', [App\Http\Controllers\Api\LotController::class, 'setprixunitaire']);
Route::get('/lots/pharmacie/{id_pharmacie}', [App\Http\Controllers\Api\LotController::class, 'getlotspharmacie']);
Route::put('/lots/{id}', [App\Http\Controllers\Api\LotController::class, 'update']);
Route::delete('/lots/{id}', [App\Http\Controllers\Api\LotController::class, 'destroy']);
// Route definitions for LotController

Route::get('/lots/{id_pharmacie}', [App\Http\Controllers\Api\LotController::class, 'getlotspharmacie']);
Route::put('/lots/{id}', [App\Http\Controllers\Api\LotController::class, 'update']);
Route::delete('/lots/{id}', [App\Http\Controllers\Api\LotController::class, 'destroy']);

//fake route
Route::post('/pharmacies', [AuthController::class, 'pharmacie']);

Route::post('/doses', [DoseController::class, 'store']);
Route::get('/doses', [DoseController::class, 'index']);

//forme
Route::post('/formes', [App\Http\Controllers\Api\FormeController::class, 'store']);
Route::get('/formes', [App\Http\Controllers\Api\FormeController::class, 'index']);


