<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpenseService;

/**
     * Author: Muhammadali
     * ExpenseController handles operations related to expenses.
 */
class ExpenseController extends AbstractController
{
    /**
     * Constructor to initialize the ExpenseService.
     *
     * @param ExpenseService $service
     */
    public function __construct(ExpenseService $service){
        $this->service = $service;
    }

    /**
     * Get the total expenses.
     *
     * @return JsonResponse
     */
    public function total()
    {
        $data = $this->service->total(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Get expenses by category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getCategoryExpenses($id)
    {
        $data = $this->service->getCategoryExpenses($id);
        return $this->sendResponse($data);
    }

    /**
     * Get currencies related to expenses.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function currencies($id)
    {
        $data = $this->service->currencies($id);
        return $this->sendResponse($data);
    }
}
