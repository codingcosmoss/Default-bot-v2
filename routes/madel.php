
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
