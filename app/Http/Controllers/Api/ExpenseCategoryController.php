<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpenseCategoryService;

/**
 * Author: Muhammadali
 * ExpenseCategoryController handles operations related to expense categories.
 */
class ExpenseCategoryController extends AbstractController
{
    /**
     * Constructor to initialize the ExpenseCategoryService.
     *
     * @param ExpenseCategoryService $service
     */
    public function __construct(ExpenseCategoryService $service){
        $this->service = $service;
    }

    /**
     * Get expenses by category and search term.
     *
     * @param int $id
     * @param string $search
     * @return JsonResponse
     */
    public function getCategoryExpensesSearch($id , $search)
    {
        $data = $this->service->getCategoryExpensesSearch($id, $search);
        return $this->sendResponse($data);
    }
}
