<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\WarehouseService;

class WarehouseController extends AbstractController
{
    public function __construct(WarehouseService $service){
        $this->service = $service;
    }

}
