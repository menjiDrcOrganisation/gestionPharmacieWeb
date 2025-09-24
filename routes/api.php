<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PharmacieController;

Route::get("/RapportVente",[App\Http\Controllers\api\RapportVenteController::class,'getRapportVente']);


require __DIR__.'/apiAuth.php';
require __DIR__.'/apiMedicament.php';
require __DIR__.'/apiVente.php';
require __DIR__.'/apiPharmacie.php';


