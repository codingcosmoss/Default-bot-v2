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

    public function changePassword()
    {
        $data = $this->service->changePassword(request()->all());
        return $this->sendResponse($data);
    }

    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }


}
