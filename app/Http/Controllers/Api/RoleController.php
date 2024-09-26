<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\RoleService;

/**
 * Author: Muhammadali
 * RoleController manages functionalities related to user roles and notifications.
 */
class RoleController extends AbstractController
{
    /**
     * Constructor to initialize the RoleService.
     *
     * @param RoleService $service
     */
    public function __construct(RoleService $service){
        $this->service = $service;
    }

    /**
     * Retrieve notifications associated with a specific role.
     *
     * @param int $id Role ID
     * @return JsonResponse
     */
    public function getNotification($id)
    {
        $data = $this->service->getRoleNotification($id);
        return $this->sendResponse($data);
    }
}
