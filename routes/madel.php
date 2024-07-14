
Route::prefix('/menu')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\MenuController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\MenuController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\MenuController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\MenuController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\MenuController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\MenuController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\MenuController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\MenuController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\MenuController::class, 'destroy']);
});
