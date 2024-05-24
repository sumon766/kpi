<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\EvaluationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('sectors', SectorController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('questions', QuestionController::class);
Route::post('/evaluations', [EvaluationController::class, 'store']);
Route::get('/leaderboard', [EvaluationController::class, 'leaderboard']);

