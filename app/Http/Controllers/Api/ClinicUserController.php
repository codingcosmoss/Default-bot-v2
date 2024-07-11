<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\ClinicUserService;
class ClinicUserController extends AbstractController
{
    public function __construct(ClinicUserService $service){
        $this->service = $service;
    }

}
