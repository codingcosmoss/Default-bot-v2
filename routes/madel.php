
Route::prefix('/expired')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\ExpiredMedicineController::class, 'destroy']);
});
