<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\CurrencyService;

/**
 * Author: Muhammadali
 * CurrencyController handles operations related to currencies, using the CurrencyService.
 */

class CurrencyController extends AbstractController
{
    /**
     * Constructor to initialize the CurrencyService.
     *
     * @param CurrencyService $service
     */
    public function __construct(CurrencyService $service){
        $this->service = $service;
    }
}

