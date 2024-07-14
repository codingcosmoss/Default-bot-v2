<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\RoleService;

class RoleController extends AbstractController
{
    public function __construct(RoleService $service){
        $this->service = $service;
    }

    public function getNotification($id)
    {
        $data = $this->service->getRoleNotification($id);
        return $this->sendResponse($data);
    }

}
