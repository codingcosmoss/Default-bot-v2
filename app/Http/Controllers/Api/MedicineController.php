<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MedicineService;

class MedicineController extends AbstractController
{
    public function __construct(MedicineService $service){
        $this->service = $service;
    }
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }

    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }

    public function activeSearch($search = '')
    {
        $data = $this->service->activeSearch($search);
        return $this->sendResponse($data);
    }
    public function quantityVerification()
    {
        $data = $this->service->quantityVerification();
        return $this->sendResponse($data);
    }


}
