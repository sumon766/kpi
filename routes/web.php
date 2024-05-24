<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectorController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::apiResource('sectors', SectorController::class);
});
