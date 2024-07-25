<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ImportedMedicineService;

class ImportedMedicineController extends AbstractController
{
    public function __construct(ImportedMedicineService $service){
        $this->service = $service;
    }

}
