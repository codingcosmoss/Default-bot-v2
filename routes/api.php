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

    Route::prefix('user')->group(function () {

        Route::get('/index', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\UserController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\UserController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\UserController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::post('/update-password/{id}', [\App\Http\Controllers\Api\UserController::class, 'changePassword']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\UserController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
        // change password
        Route::post('/changePassword', [\App\Http\Controllers\Api\UserController::class, 'changePassword']);
    });

    Route::prefix('/role')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\RoleController::class, 'index']);
        Route::get('/notification/{id}', [\App\Http\Controllers\Api\RoleController::class, 'getNotification']);
        Route::get('/actives', [\App\Http\Controllers\Api\RoleController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\RoleController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\RoleController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\RoleController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\RoleController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\RoleController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\RoleController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\RoleController::class, 'destroy']);
    });

    Route::prefix('/menu')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\MenuController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\MenuController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\MenuController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\MenuController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\MenuController::class, 'show']);
    });


    Route::prefix('/setting')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\SettingController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\SettingController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\SettingController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\SettingController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SettingController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SettingController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SettingController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\SettingController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SettingController::class, 'destroy']);
    });

    Route::prefix('/customer')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\CustomerController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\CustomerController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\CustomerController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\CustomerController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CustomerController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\CustomerController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'destroy']);
    });

    Route::prefix('/expense')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\ExpenseController::class, 'index']);
        Route::get('/total', [\App\Http\Controllers\Api\ExpenseController::class, 'total']);
        Route::get('/currencies/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'currencies']);
        Route::get('/actives', [\App\Http\Controllers\Api\ExpenseController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ExpenseController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ExpenseController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ExpenseController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\ExpenseController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'destroy']);
    });


    Route::prefix('/expense_category')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'destroy']);
    });

    Route::prefix('/currency')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\CurrencyController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\CurrencyController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\CurrencyController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\CurrencyController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CurrencyController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CurrencyController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\CurrencyController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\CurrencyController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\CurrencyController::class, 'destroy']);
    });

});

