
Route::prefix('/invoice')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\InvoiceController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\InvoiceController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\InvoiceController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\InvoiceController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\InvoiceController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\InvoiceController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\InvoiceController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\InvoiceController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\InvoiceController::class, 'destroy']);
});
