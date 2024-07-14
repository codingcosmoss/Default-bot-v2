<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\UserService;

class UserController extends AbstractController
{
    public function __construct(UserService $service){
        $this->service = $service;
    }

    public function changePassword($id)
    {
        $data = $this->service->changePassword(request()->all(), $id);
        return $this->sendResponse($data);
    }

    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }



}
