
Route::prefix('/imported-medicine')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\ImportedMedicineController::class, 'destroy']);
});
