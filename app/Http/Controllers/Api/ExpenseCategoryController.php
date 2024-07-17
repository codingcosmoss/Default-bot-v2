<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpenseCategoryService;

class ExpenseCategoryController extends AbstractController
{
    public function __construct(ExpenseCategoryService $service){
        $this->service = $service;
    }

}
