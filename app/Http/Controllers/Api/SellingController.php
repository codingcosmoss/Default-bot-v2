<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SellingService;

class SellingController extends AbstractController
{
    public function __construct(SellingService $service){
        $this->service = $service;
    }

}
