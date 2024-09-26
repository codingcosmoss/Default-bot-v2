<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MedicineService;
/**
 * Author: Muhammadali
 * MedicineController manages operations related to medicines.
 */
class MedicineController extends AbstractController
{
    /**
     * Constructor to initialize the MedicineService.
     *
     * @param MedicineService $service
     */
    public function __construct(MedicineService $service){
        $this->service = $service;
    }

    /**
     * Create a new medicine entry.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }

    /**
     * Update an existing medicine entry.
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }

    /**
     * Search for active medicines based on a search term.
     *
     * @param string $search
     * @return JsonResponse
     */
    public function activeSearch($search = '')
    {
        $data = $this->service->activeSearch($search);
        return $this->sendResponse($data);
    }

    /**
     * Verify the quantity of medicines.
     *
     * @return JsonResponse
     */
    public function quantityVerification()
    {
        $data = $this->service->quantityVerification();
        return $this->sendResponse($data);
    }
}
