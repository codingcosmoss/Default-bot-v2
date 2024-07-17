<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\CurrencyService;

class CurrencyController extends AbstractController
{
    public function __construct(CurrencyService $service){
        $this->service = $service;
    }



}
