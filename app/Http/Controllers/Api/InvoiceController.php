<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\InvoiceService;

class InvoiceController extends AbstractController
{
    public function __construct(InvoiceService $service){
        $this->service = $service;
    }
    public function returns($count)
    {
        $data = $this->service->returns($count);
        return $this->sendResponse($data);
    }
    public function toPay()
    {
        $data = $this->service->toPay(request()->all());
        return $this->sendResponse($data);
    }
    public function searchDate()
    {
        $data = $this->service->searchDate(request()->all());
        return $this->sendResponse($data);
    }

    public function returnSearchDate()
    {
        $data = $this->service->returnSearchDate(request()->all());
        return $this->sendResponse($data);
    }
    public function returnMedicine()
    {
        $data = $this->service->returnMedicine(request()->all());
        return $this->sendResponse($data);
    }
}
