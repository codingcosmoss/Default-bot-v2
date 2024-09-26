<?php
namespace App\Http\Controllers\Api;

use App\Models\DocumentPayment;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\DocumenPaymentService;

/**
 * Author: Muhammadali
 * Controller for managing document payments, extends base functionality from AbstractController.
 **/
class DocumentPaymentController extends AbstractController
{
    /**
     * Constructor for initializing the DocumentPaymentService.
     *
     * @param DocumenPaymentService $service
     **/
    public function __construct(DocumenPaymentService $service){
        $this->service = $service;
    }
}

