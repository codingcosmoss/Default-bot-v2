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

// Super Admin
Route::middleware(['auth:sanctum', 'admin' ])->group(function () {

    // Phrase => Turkumlar
    Route::group([ 'prefix' => 'phrase' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\PhraseController::class, 'index']);
    });

    //topics => Mavzular
    Route::group([ 'prefix' => 'topic' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\TopicController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\TopicController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\TopicController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\TopicController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\TopicController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\TopicController::class, 'delete']);
    });

    //words => So'zlar
    Route::group([ 'prefix' => 'word' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\WordController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\WordController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\WordController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\WordController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\WordController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\WordController::class, 'delete']);
    });

    //words => Saqlash uchun So'zlar
    Route::group([ 'prefix' => 'saved-word' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\SavedWordController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'show']);
        Route::get('/first', [\App\Http\Controllers\Api\SavedWordController::class, 'showFirst']);
        Route::post('/create', [\App\Http\Controllers\Api\SavedWordController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\SavedWordController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'delete']);
    });

    //words => Saqlash uchun So'zlar
    Route::group([ 'prefix' => 'saved-word' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\SavedWordController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'show']);
        Route::get('/show/first', [\App\Http\Controllers\Api\SavedWordController::class, 'showFirst']);
        Route::post('/create', [\App\Http\Controllers\Api\SavedWordController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\SavedWordController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SavedWordController::class, 'delete']);
    });

    //words => Saqlash uchun So'zlar
    Route::group([ 'prefix' => 'source' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\SourceController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SourceController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SourceController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SourceController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\SourceController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SourceController::class, 'delete']);
    });



});



// Chat user
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Gapning ifoda maqsadiga ko'ra turini aniqlash
    Route::post('expression', [\App\Http\Controllers\Api\GenerationController::class, 'expression']);
});

