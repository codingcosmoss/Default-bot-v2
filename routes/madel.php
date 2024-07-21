
Route::prefix('/warehouse')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\WarehouseController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\WarehouseController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\WarehouseController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\WarehouseController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\WarehouseController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\WarehouseController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'destroy']);
});
