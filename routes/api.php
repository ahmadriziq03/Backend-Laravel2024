<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/animals', [AnimalController::class, 'index']);
Route::post('/animals', [AnimalController::class,'store']);
Route::put('/animals/{id}', [AnimalController::class,'update']);
Route::delete('/animals/{id}', [AnimalController::class,'destroy']);

Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/{id}', [StudentController::class, 'show']);



