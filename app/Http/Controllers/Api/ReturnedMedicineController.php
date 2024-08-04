<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ReturnedMedicineService;

class ReturnedMedicineController extends AbstractController
{
    public function __construct(ReturnedMedicineService $service){
        $this->service = $service;
    }

}
