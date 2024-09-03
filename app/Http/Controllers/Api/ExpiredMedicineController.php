<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpiredMedicineService;

class ExpiredMedicineController extends AbstractController
{
    public function __construct(ExpiredMedicineService $service){
        $this->service = $service;
    }

}
