<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('api')->group(function () {

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

});

Route::middleware('auth:sanctum')->group(function () {

    // Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('logout', [LoginController::class, 'destroy']);

});