
Route::prefix('/drug-company')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\DrugCompanyController::class, 'index']);
    Route::get('/actives', [\App\Http\Controllers\Api\DrugCompanyController::class, 'activeIndex']);
    Route::get('/paginate/{count}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'getPaginate']);
    Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'orderBy']);
    Route::get('/show/{id}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'show']);
    Route::post('/create', [\App\Http\Controllers\Api\DrugCompanyController::class, 'create']);
    Route::post('/update/{id}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'update']);
    Route::get('/search/{search}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'search']);
    Route::get('/delete/{id}', [\App\Http\Controllers\Api\DrugCompanyController::class, 'destroy']);
});
