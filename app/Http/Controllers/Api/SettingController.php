<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SettingService;
use http\Env\Request;

class SettingController extends AbstractController
{
    public function __construct(SettingService $service){
        $this->service = $service;
    }

    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }

    public function updateCurrency()
    {
        $data = $this->service->updateCurrency(request()->all());
        return $this->sendResponse($data);
    }

}
