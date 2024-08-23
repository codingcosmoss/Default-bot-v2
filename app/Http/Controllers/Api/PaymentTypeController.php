<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\PaymentTypeService;

class PaymentTypeController extends AbstractController
{
    public function __construct(PaymentTypeService $service){
        $this->service = $service;
    }

    public function getCustomerPaginate($count)
    {
        $data = $this->service->getCustomerPaginate($count);
        return $this->sendResponse($data);
    }
    public function searchCustomers($search)
    {
        $data = $this->service->searchCustomers($search);
        return $this->sendResponse($data);
    }
    public function getSupplierPaginate($count)
    {
        $data = $this->service->getSupplierPaginate($count);
        return $this->sendResponse($data);
    }
    public function searchSuppliers($search)
    {
        $data = $this->service->searchSuppliers($search);
        return $this->sendResponse($data);
    }


}
