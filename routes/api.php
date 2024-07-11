<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::prefix('clinic')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'clinicLogin']);
    // Super Admin
    Route::middleware(['auth:sanctum', 'clinic.user' ])->group(function () {
        Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

        Route::prefix('user')->group(function () {
            Route::get('/index', [\App\Http\Controllers\Api\ClinicUserController::class, 'index']);
            Route::get('/actives', [\App\Http\Controllers\Api\ClinicUserController::class, 'activeIndex']);
            Route::get('/get/paginate/{count}', [\App\Http\Controllers\Api\ClinicUserController::class, 'getPaginate']);
            Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ClinicUserController::class, 'orderBy']);
            Route::get('/show/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'show']);
            Route::post('/create', [\App\Http\Controllers\Api\ClinicUserController::class, 'create']);
            Route::post('/update/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'update']);
            Route::get('/search/{search}', [\App\Http\Controllers\Api\ClinicUserController::class, 'search']);
            Route::get('/delete/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'destroy']);
        });

    });

});

// Super Admin
Route::middleware(['auth:sanctum', 'admin' ])->group(function () {

    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);



});
