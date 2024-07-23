
Route::prefix('/document')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\DocumentController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\DocumentController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\DocumentController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\DocumentController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\DocumentController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\DocumentController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'destroy']);
});
