
Route::prefix('/user')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\UserController::class, 'index']);
    Route::get('/index/actives', [\App\Http\Controllers\Api\UserController::class, 'activeIndex']);
    Route::get('/get/paginate/{count}', [\App\Http\Controllers\Api\UserController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\UserController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\UserController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
});
