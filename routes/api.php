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
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

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


    //source =>  So'z manbalari
    Route::group([ 'prefix' => 'source' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\SourceController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SourceController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SourceController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SourceController::class, 'update']);
        Route::post('/search', [\App\Http\Controllers\Api\SourceController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SourceController::class, 'delete']);
    });
});

//chat =>  Chat
Route::group([ 'prefix' => 'chat' ], function () {
    Route::get('/get-messages/{id}', [\App\Http\Controllers\Api\ChatController::class, 'getMessages']);
    Route::post('/send-message', [\App\Http\Controllers\Api\ChatController::class, 'sendMessage']);
});

//source =>  So'z manbalari
Route::group([ 'prefix' => 'socket' ], function () {
    Route::get('/search-word-type', [\App\Http\Controllers\GeneratedService::class, 'searchWordType']);
    Route::get('/search-word', [\App\Http\Controllers\GeneratedService::class, 'searchWord']);
    Route::get('/generate-message', [\App\Http\Controllers\GeneratedService::class, 'generateMessage']);
    Route::get('/generate-word', [\App\Http\Controllers\GeneratedService::class, 'generateWord']);
});


