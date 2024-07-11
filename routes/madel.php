
Route::prefix('/route')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\ClinicUserController::class, 'index']);
    Route::get('/index/actives', [\App\Http\Controllers\Api\ClinicUserController::class, 'activeIndex']);
    Route::get('/get/paginate/{count}', [\App\Http\Controllers\Api\ClinicUserController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ClinicUserController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\ClinicUserController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\ClinicUserController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'destroy']);
});
