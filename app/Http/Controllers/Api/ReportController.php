<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanySetting;
use App\Services\Api\ReportService;

class ReportController extends AbstractController
{

    protected $service = ReportService::class;

    public function employeesPaymentIndex()
    {
        $items = $this->service->employeesPaymentIndex(request()->all());
        return $this->sendResponse($items);
    }
    public function getMoonTreatments()
    {
        $items = $this->service->getMoonTreatments(request()->all());
        return $this->sendResponse($items);
    }


    public function dashboard()
    {
        $items = $this->service->dashboard(request()->all());
        return $this->sendResponse($items);
    }
    public function permissions()
    {
        $items = $this->service->permissions(request()->all());
        return $this->sendResponse($items);
    }


    public function reports($start, $end)
    {
        $items = $this->service->reports($start, $end);
        return $this->sendResponse($items);
    }

    public function dalyTreatments($year, $moon)
    {
        $items = $this->service->dalyTreatments($year, $moon);
        return $this->sendResponse($items);
    }

    public function givenMoneys()
    {
        $items = $this->service->givenMoneys(request()->all());
        return $this->sendResponse($items);
    }
    public function employeesPaymentStore()
    {
        $items = $this->service->employeesPaymentStore(request()->all());
        return $this->sendResponse($items);
    }

    public function employeesPaymentShow($id)
    {
        $item = $this->service->employeesPaymentShow($id);

        return $this->sendResponse($item);
    }

    public function search()
    {
        $item = $this->service->search(request()->all());

        return $this->sendResponse($item);
    }





}
