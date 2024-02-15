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

    // Services Category
    Route::group(['prefix' => 'service_category'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'search']);
    });

    // Services
    Route::group(['prefix' => 'service'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ServiceController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\ServiceController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\ServiceController::class, 'search']);
    });

    // Patients
    Route::group(['prefix' => 'patient'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\PatientController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\PatientController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\PatientController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PatientController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\PatientController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\PatientController::class, 'search']);
    });

    // Diseases
    Route::group(['prefix' => 'disease'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\DiseasesController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\DiseasesController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\DiseasesController::class, 'search']);
    });






});
