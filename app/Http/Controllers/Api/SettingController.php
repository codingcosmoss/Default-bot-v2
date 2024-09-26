<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SettingService;
use http\Env\Request;

/**
 * Author: Muhammadali
 * SettingController manages settings and configurations.
 */
class SettingController extends AbstractController
{
    /**
     * Constructor to initialize the SettingService.
     *
     * @param SettingService $service
     */
    public function __construct(SettingService $service){
        $this->service = $service;
    }

    /**
     * Update settings for a given ID or create new settings if ID is null.
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
     * Update currency settings.
     *
     * @return JsonResponse
     */
    public function updateCurrency()
    {
        $data = $this->service->updateCurrency(request()->all());
        return $this->sendResponse($data);
    }
}

