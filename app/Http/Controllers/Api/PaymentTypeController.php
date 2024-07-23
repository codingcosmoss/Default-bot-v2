<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\PaymentTypeService;

class PaymentTypeController extends AbstractController
{
    public function __construct(PaymentTypeService $service){
        $this->service = $service;
    }

}
