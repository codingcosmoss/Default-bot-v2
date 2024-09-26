<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ReturnedMedicineService;

/**
 * Author: Muhammadali
 * ReturnedMedicineController handles the functionalities related to returned medicines.
 */
class ReturnedMedicineController extends AbstractController
{
    /**
     * Constructor to initialize the ReturnedMedicineService.
     *
     * @param ReturnedMedicineService $service
     */
    public function __construct(ReturnedMedicineService $service){
        $this->service = $service;
    }
}
