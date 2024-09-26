<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\CustomerService;


/**
 * Author: Muhammadali
 * CustomerController manages customer-related operations, utilizing the CustomerService.
 */
class CustomerController extends AbstractController
{
    /**
     * Constructor to initialize the CustomerService.
     *
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service){
        $this->service = $service;
    }

    /**
     * Create a new customer and return the response.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }

    /**
     * Update an existing customer by ID and return the response.
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
