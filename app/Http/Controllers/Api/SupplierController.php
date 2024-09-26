<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\CustomerService;
use App\Services\Api\SupplierService;

/**
 * Author: Muhammadali
 * SupplierController handles operations related to suppliers.
 */
class SupplierController extends AbstractController
{
    /**
     * Constructor to initialize the SupplierService.
     *
     * @param SupplierService $service
     */
    public function __construct(SupplierService $service){
        $this->service = $service;
    }

    /**
     * Create a new supplier and store it in the database.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }

    /**
     * Update an existing supplier with the given ID.
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }
}
