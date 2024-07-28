<?php
namespace App\Http\Controllers\Api;

use App\Models\DocumentPayment;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\DocumenPaymentService;

class DocumentPaymentController extends AbstractController
{
    public function __construct(DocumenPaymentService $service){
        $this->service = $service;
    }

}
