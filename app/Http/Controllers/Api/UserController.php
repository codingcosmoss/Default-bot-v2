<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\UserService;

/**
 * Author: Muhammadali
 * UserController manages user-related operations, including profile updates, password changes, and user creation.
 */
class UserController extends AbstractController
{
    /**
     * Constructor to initialize the UserService.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service){
        $this->service = $service;
    }

    /**
     * Update the user profile with the given ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function profilUpdate($id)
    {
        $data = $this->service->profilUpdate(request()->all(), $id, request());
        return $this->sendResponse($data);
    }

    /**
     * Change the password for the user with the given ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function changePassword($id)
    {
        $data = $this->service->changePassword(request()->all(), $id);
        return $this->sendResponse($data);
    }

    /**
     * Update the user with the given ID.
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
     * Create a new user and store it in the database.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }
}
