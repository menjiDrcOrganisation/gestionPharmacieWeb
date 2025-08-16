<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return "bonjour";
});
require __DIR__.'/apiAuth.php';

// ->middleware('auth:sanctum');
// Route
