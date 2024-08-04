
Route::prefix('/returned-medicine')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\ReturnedMedicineController::class, 'destroy']);
});
