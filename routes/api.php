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
Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::prefix('clinic')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'clinicLogin']);
    // Super Admin
    Route::middleware(['auth:sanctum', 'clinic.user' ])->group(function () {
        Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

        Route::prefix('user')->group(function () {
            Route::get('/index', [\App\Http\Controllers\Api\ClinicUserController::class, 'index']);
            Route::get('/actives', [\App\Http\Controllers\Api\ClinicUserController::class, 'activeIndex']);
            Route::get('/get/paginate/{count}', [\App\Http\Controllers\Api\ClinicUserController::class, 'getPaginate']);
            Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ClinicUserController::class, 'orderBy']);
            Route::get('/show/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'show']);
            Route::post('/create', [\App\Http\Controllers\Api\ClinicUserController::class, 'create']);
            Route::post('/update/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'update']);
            Route::get('/search/{search}', [\App\Http\Controllers\Api\ClinicUserController::class, 'search']);
            Route::get('/delete/{id}', [\App\Http\Controllers\Api\ClinicUserController::class, 'destroy']);
        });

    });

});

// Super Admin
Route::middleware(['auth:sanctum', 'admin' ])->group(function () {
    Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::get('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::prefix('user')->group(function () {

        Route::get('/index', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\UserController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\UserController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\UserController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::post('/profil-update/{id}', [\App\Http\Controllers\Api\UserController::class, 'profilUpdate']);
        Route::post('/update-password/{id}', [\App\Http\Controllers\Api\UserController::class, 'changePassword']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\UserController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
        // change password
        Route::post('/changePassword', [\App\Http\Controllers\Api\UserController::class, 'changePassword']);
    });

    Route::prefix('/role')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\RoleController::class, 'index']);
        Route::get('/notification/{id}', [\App\Http\Controllers\Api\RoleController::class, 'getNotification']);
        Route::get('/actives', [\App\Http\Controllers\Api\RoleController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\RoleController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\RoleController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\RoleController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\RoleController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\RoleController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\RoleController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\RoleController::class, 'destroy']);
    });

    Route::prefix('/menu')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\MenuController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\MenuController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\MenuController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\MenuController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\MenuController::class, 'show']);
    });


    Route::prefix('/setting')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\SettingController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\SettingController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\SettingController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\SettingController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SettingController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SettingController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SettingController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\SettingController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SettingController::class, 'destroy']);
    });

    Route::prefix('/customer')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\CustomerController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\CustomerController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\CustomerController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\CustomerController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CustomerController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\CustomerController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\CustomerController::class, 'destroy']);
    });

    Route::prefix('/expense')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\ExpenseController::class, 'index']);
        Route::get('/total', [\App\Http\Controllers\Api\ExpenseController::class, 'total']);
        Route::get('/category-expenses/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'getCategoryExpenses']);
        Route::get('/currencies/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'currencies']);
        Route::get('/actives', [\App\Http\Controllers\Api\ExpenseController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ExpenseController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ExpenseController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ExpenseController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\ExpenseController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ExpenseController::class, 'destroy']);
    });


    Route::prefix('/expense_category')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'index']);
        Route::get('/expenses/{id}/{search}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'getCategoryExpensesSearch']);
        Route::get('/actives', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\ExpenseCategoryController::class, 'destroy']);
    });

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

    Route::prefix('/supplier')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\SupplierController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\SupplierController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\SupplierController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\SupplierController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SupplierController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\SupplierController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'destroy']);
    });

    Route::prefix('/size-type')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\SizeTypeController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\SizeTypeController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\SizeTypeController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\SizeTypeController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\SizeTypeController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\SizeTypeController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\SizeTypeController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\SizeTypeController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\SizeTypeController::class, 'destroy']);
    });

    Route::prefix('/box-size')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\BoxSizeController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\BoxSizeController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\BoxSizeController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\BoxSizeController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\BoxSizeController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\BoxSizeController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\BoxSizeController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\BoxSizeController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\BoxSizeController::class, 'destroy']);
    });

    Route::prefix('/medicine-category')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\MedicineCategoryController::class, 'destroy']);
    });

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

    Route::prefix('/medicine')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\MedicineController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\MedicineController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\MedicineController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\MedicineController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\MedicineController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\MedicineController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\MedicineController::class, 'update']);
        Route::get('/active-search/{search}', [\App\Http\Controllers\Api\MedicineController::class, 'activeSearch']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\MedicineController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\MedicineController::class, 'destroy']);
    });


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

    Route::prefix('/payment-type')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\PaymentTypeController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\PaymentTypeController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\PaymentTypeController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\PaymentTypeController::class, 'destroy']);
    });

    Route::prefix('/document')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\DocumentController::class, 'index']);
        Route::get('/actives', [\App\Http\Controllers\Api\DocumentController::class, 'activeIndex']);
        Route::get('/paginate/{count}', [\App\Http\Controllers\Api\DocumentController::class, 'getPaginate']);
        Route::get('/orderBy/{column}/{type}', [\App\Http\Controllers\Api\DocumentController::class, 'orderBy']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\DocumentController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'update']);
        Route::get('/search/{search}', [\App\Http\Controllers\Api\DocumentController::class, 'search']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Api\DocumentController::class, 'destroy']);
    });

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



});

