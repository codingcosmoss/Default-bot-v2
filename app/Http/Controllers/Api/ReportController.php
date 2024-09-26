<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ReportService;

/**
 * Author: Muhammadali
 * ReportController handles various report-related functionalities.
 */
class ReportController extends AbstractController
{
    /**
     * Constructor to initialize the ReportService.
     *
     * @param ReportService $service
     */
    public function __construct(ReportService $service){
        $this->service = $service;
    }

    /**
     * Retrieves sales data with pagination.
     *
     * @param int $count Number of items per page.
     * @return JsonResponse
     */
    public function getSallings($count)
    {
        $data = $this->service->getSallings($count);
        return $this->sendResponse($data);
    }

    /**
     * Retrieves data for the first dashboard chart.
     *
     * @return JsonResponse
     */
    public function dashboardCart1()
    {
        $data = $this->service->dashboardCart1();
        return $this->sendResponse($data);
    }

    /**
     * Retrieves data for the second dashboard chart.
     *
     * @return JsonResponse
     */
    public function dashboardCart2()
    {
        $data = $this->service->dashboardCart2();
        return $this->sendResponse($data);
    }

    /**
     * Retrieves purchase data with pagination.
     *
     * @param int $count Number of items per page.
     * @return JsonResponse
     */
    public function getPurchases($count)
    {
        $data = $this->service->getPurchases($count);
        return $this->sendResponse($data);
    }

    /**
     * Retrieves best sellers data with pagination.
     *
     * @param int $count Number of items per page.
     * @return JsonResponse
     */
    public function getBestSellers($count)
    {
        $data = $this->service->getBestSellers($count);
        return $this->sendResponse($data);
    }
}
