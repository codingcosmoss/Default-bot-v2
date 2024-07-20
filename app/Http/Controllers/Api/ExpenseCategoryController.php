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

    public function getCategoryExpensesSearch($id , $search)
    {
        $data = $this->service->getCategoryExpensesSearch($id, $search);
        return $this->sendResponse($data);
    }

}
