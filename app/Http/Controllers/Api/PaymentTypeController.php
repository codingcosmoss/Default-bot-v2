<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\PaymentTypeService;

/**
 * Author: Muhammadali
 * PaymentTypeController manages payment types and their related operations.
 */
class PaymentTypeController extends AbstractController
{
    /**
     * Constructor to initialize the PaymentTypeService.
     *
     * @param PaymentTypeService $service
     */
    public function __construct(PaymentTypeService $service){
        $this->service = $service;
    }

    /**
     * Retrieves a paginated list of customer payment types.
     *
     * @param int $count Number of items per page.
     * @return JsonResponse
     */
    public function getCustomerPaginate($count)
    {
        $data = $this->service->getCustomerPaginate($count);
        return $this->sendResponse($data);
    }

    /**
     * Searches for customer payment types based on the search query.
     *
     * @param string $search Search query.
     * @return JsonResponse
     */
    public function searchCustomers($search)
    {
        $data = $this->service->searchCustomers($search);
        return $this->sendResponse($data);
    }

    /**
     * Retrieves a paginated list of supplier payment types.
     *
     * @param int $count Number of items per page.
     * @return JsonResponse
     */
    public function getSupplierPaginate($count)
    {
        $data = $this->service->getSupplierPaginate($count);
        return $this->sendResponse($data);
    }

    /**
     * Searches for supplier payment types based on the search query.
     *
     * @param string $search Search query.
     * @return JsonResponse
     */
    public function searchSuppliers($search)
    {
        $data = $this->service->searchSuppliers($search);
        return $this->sendResponse($data);
    }
}
