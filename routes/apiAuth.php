<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;




Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'registerusers']);
Route::get('/users', [AuthController::class, 'show']);
Route::Post('/pharmacies', [AuthController::class, 'pharmacie']);
Route::Post('/registerVendeur', [AuthController::class, 'registerVendeur']);
//fake route
Route::post('/pharmacie', [AuthController::class, 'pharmacie']);
