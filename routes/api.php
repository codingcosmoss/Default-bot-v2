<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::get('/test', [\App\Http\Controllers\Api\AuthController::class, 'test']);

// ADMIN PANEL
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Xodimlar
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\EmployeesController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\EmployeesController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\EmployeesController::class, 'delete']);
        Route::post('/test-login', [\App\Http\Controllers\Api\EmployeesController::class, 'testLogin']);
        Route::post('/search', [\App\Http\Controllers\Api\EmployeesController::class, 'search']);
        Route::post('/update-password', [\App\Http\Controllers\Api\EmployeesController::class, 'updatePassword']);
    });

    // Services Category
    Route::group(['prefix' => 'service_category'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\ServiceCategoryController::class, 'search']);
    });

    // Services
    Route::group(['prefix' => 'service'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ServiceController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\ServiceController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ServiceController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\ServiceController::class, 'search']);
    });

    // Patients
    Route::group(['prefix' => 'patient'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\PatientController::class, 'index']);
        Route::post('/create', [\App\Http\Controllers\Api\PatientController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\PatientController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PatientController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\PatientController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\PatientController::class, 'search']);

        Route::post('/join-doctor', [\App\Http\Controllers\Api\PatientController::class, 'joinDr']);
    });

    // Diseases
    Route::group(['prefix' => 'disease'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\DiseasesController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\DiseasesController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\DiseasesController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\DiseasesController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\DiseasesController::class, 'search']);
    });

    // Treatmetns
    Route::group(['prefix' => 'treatmetn'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\TreatmentController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\TreatmentController::class, 'show']);
        Route::post('/search', [\App\Http\Controllers\Api\TreatmentController::class, 'search']);
        Route::post('/discount', [\App\Http\Controllers\Api\TreatmentController::class, 'discount']);
    });

    Route::post('/treatment-add-service', [\App\Http\Controllers\Api\TreatmentController::class, 'treatmentAddService']);
    Route::get('/treatment-add-all/{id}', [\App\Http\Controllers\Api\TreatmentController::class, 'treatmentAddServiceAll']);
    Route::post('/treatment-saved-service', [\App\Http\Controllers\Api\TreatmentController::class, 'treatmentSavedService']);
    // Davolanishni yakunlash
    Route::get('/treatment-finished/{id}', [\App\Http\Controllers\Api\TreatmentController::class, 'treatmentFinished']);


    // Paymetn Types
    Route::group(['prefix' => 'payment-type'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\PaymentTypeController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\PaymentTypeController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\PaymentTypeController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\PaymentTypeController::class, 'search']);
    });

    // Paymetns
    Route::group(['prefix' => 'payment'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\PaymentController::class, 'index']);
        Route::get('/get-user-payments/{id}', [\App\Http\Controllers\Api\PaymentController::class, 'getUserPayments']);
        Route::post('/get-user-treatment-payments', [\App\Http\Controllers\Api\PaymentController::class, 'getUserTreatmentPayments']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\PaymentController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\PaymentController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\PaymentController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PaymentController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\PaymentController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\PaymentController::class, 'search']);
    });

    // Warehouse Category
    Route::group(['prefix' => 'warehouse-category'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\WarehouseCategoryController::class, 'search']);
    });

    // Filials
    Route::group(['prefix' => 'filial'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\FilialController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\FilialController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\FilialController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\FilialController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\FilialController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\FilialController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\FilialController::class, 'search']);
    });


    // Warehouse
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/index', [\App\Http\Controllers\Api\WarehouseController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\WarehouseController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\WarehouseController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\WarehouseController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\WarehouseController::class, 'search']);
    });

    // Groups
    Route::group([ 'prefix' => 'group' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\GroupController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\GroupController::class, 'isActives']);
        Route::post('/create', [\App\Http\Controllers\Api\GroupController::class, 'create']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\GroupController::class, 'show']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\GroupController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\GroupController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\GroupController::class, 'search']);
    });

    // Products
    Route::group([ 'prefix' => 'product' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ProductController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\ProductController::class, 'isActives']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ProductController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ProductController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\ProductController::class, 'search']);
    });

    // Collections
    Route::group([ 'prefix' => 'collection' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\CollectionController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\CollectionController::class, 'isActives']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CollectionController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CollectionController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\CollectionController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\CollectionController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\CollectionController::class, 'search']);
    });

    // product_documents
    Route::group([ 'prefix' => 'product-document' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\ProductDocumentController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\ProductDocumentController::class, 'isActives']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ProductDocumentController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ProductDocumentController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ProductDocumentController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ProductDocumentController::class, 'delete']);
        Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductDocumentController::class, 'getProducts']);
        Route::post('/search', [\App\Http\Controllers\Api\ProductDocumentController::class, 'search']);

    });
    Route::post('/imported-products', [\App\Http\Controllers\Api\ProductDocumentController::class, 'importedProducts']);


    // product_documents
    Route::group([ 'prefix' => 'supplier' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\SupplierController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\SupplierController::class, 'isActives']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SupplierController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\SupplierController::class, 'search']);
    });

    //  OwedTreatment users
    Route::group([ 'prefix' => 'owed-treatment' ], function () {
        Route::get('/index', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'index']);
        Route::get('/is-actives', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'isActives']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'delete']);
        Route::post('/search', [\App\Http\Controllers\Api\OwedTreatmentController::class, 'search']);
    });





});
