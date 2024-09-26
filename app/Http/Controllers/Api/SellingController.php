<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SellingService;

/**
 * Author: Muhammadali
 * SellingController handles functionalities related to sales management.
 */
class SellingController extends AbstractController
{
    /**
     * Constructor to initialize the SellingService.
     *
     * @param SellingService $service
     */
    public function __construct(SellingService $service){
        $this->service = $service;
    }
}

