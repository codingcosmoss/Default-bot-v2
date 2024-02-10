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

Route::get('/test', [\App\Http\Controllers\Api\AuthController::class, 'test']);

// ADMIN PANEL
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Xodimlar
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\EmployeesController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\EmployeesController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'delete']);
        Route::post('/test-login', [\App\Http\Controllers\Api\EmployeesController::class, 'testLogin']);
        Route::post('/search', [\App\Http\Controllers\Api\EmployeesController::class, 'search']);
        Route::post('/update-password', [\App\Http\Controllers\Api\EmployeesController::class, 'updatePassword']);
    });


});
