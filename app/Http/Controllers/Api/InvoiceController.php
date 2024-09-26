<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\InvoiceService;

/**
 * Author: Muhammadali
 * InvoiceController handles operations related to invoices, including returns, payments, and search functionalities.
 */
class InvoiceController extends AbstractController
{
    /**
     * Constructor to initialize the InvoiceService.
     *
     * @param InvoiceService $service
     */
    public function __construct(InvoiceService $service){
        $this->service = $service;
    }

    /**
     * Retrieves invoice returns based on the count specified.
     *
     * @param int $count
     * @return JsonResponse
     */
    public function returns($count)
    {
        $data = $this->service->returns($count);
        return $this->sendResponse($data);
    }

    /**
     * Retrieves invoices that are to be paid based on the request parameters.
     *
     * @return JsonResponse
     */
    public function toPay()
    {
        $data = $this->service->toPay(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Searches for invoices based on date criteria specified in the request.
     *
     * @return JsonResponse
     */
    public function searchDate()
    {
        $data = $this->service->searchDate(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Searches for return invoices based on date criteria specified in the request.
     *
     * @return JsonResponse
     */
    public function returnSearchDate()
    {
        $data = $this->service->returnSearchDate(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Retrieves information about returned medicines based on request parameters.
     *
     * @return JsonResponse
     */
    public function returnMedicine()
    {
        $data = $this->service->returnMedicine(request()->all());
        return $this->sendResponse($data);
    }
}
