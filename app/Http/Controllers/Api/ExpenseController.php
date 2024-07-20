<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpenseService;

class ExpenseController extends AbstractController
{
    public function __construct(ExpenseService $service){
        $this->service = $service;
    }
    public function total()
    {
        $data = $this->service->total(request()->all());
        return $this->sendResponse($data);
    }

    public function getCategoryExpenses($id)
    {
        $data = $this->service->getCategoryExpenses($id);
        return $this->sendResponse($data);
    }

    public function currencies($id)
    {
        $data = $this->service->currencies($id);
        return $this->sendResponse($data);
    }


}
