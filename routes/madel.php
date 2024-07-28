
Route::prefix('/document-payment')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\DocumentPaymentController::class, 'destroy']);
});
