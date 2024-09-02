<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\ReportService;

class ReportController extends AbstractController
{
    public function __construct(ReportService $service){
        $this->service = $service;
    }
    public function getSallings($count)
    {
        $data = $this->service->getSallings($count);
        return $this->sendResponse($data);
    }
    public function dashboardCart1()
    {
        $data = $this->service->dashboardCart1();
        return $this->sendResponse($data);
    }
    public function dashboardCart2()
    {
        $data = $this->service->dashboardCart2();
        return $this->sendResponse($data);
    }

    public function getPurchases($count)
    {
        $data = $this->service->getPurchases($count);
        return $this->sendResponse($data);
    }

    public function getBestSellers($count)
    {
        $data = $this->service->getBestSellers($count);
        return $this->sendResponse($data);
    }

}
