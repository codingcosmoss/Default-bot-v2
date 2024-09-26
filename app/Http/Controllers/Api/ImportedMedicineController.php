<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ImportedMedicineService;

/**
 * Author: Muhammadali
 * ImportedMedicineController manages operations related to imported medicines.
 */
class ImportedMedicineController extends AbstractController
{
    /**
     * Constructor to initialize the ImportedMedicineService.
     *
     * @param ImportedMedicineService $service
     */
    public function __construct(ImportedMedicineService $service){
        $this->service = $service;
    }

    /**
     * Retrieves medicines associated with a specific supplier.
     *
     * @param int $supplier_id
     * @return JsonResponse
     */
    public function supplierMedicines($supplier_id)
    {
        $data = $this->service->supplierMedicines($supplier_id);
        return $this->sendResponse($data);
    }
}

