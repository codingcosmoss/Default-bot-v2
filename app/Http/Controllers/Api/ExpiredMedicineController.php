<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ExpiredMedicineService;

/**
 * Author: Muhammadali
 * ExpiredMedicineController handles operations related to expired medicines.
 */
class ExpiredMedicineController extends AbstractController
{
    /**
     * Constructor to initialize the ExpiredMedicineService.
     *
     * @param ExpiredMedicineService $service
     */
    public function __construct(ExpiredMedicineService $service){
        $this->service = $service;
    }
}

