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
    public function searchDate()
    {
        $data = $this->service->searchDate(request()->all());
        return $this->sendResponse($data);
    }
    public function returnMedicine()
    {
        $data = $this->service->returnMedicine(request()->all());
        return $this->sendResponse($data);
    }
}
