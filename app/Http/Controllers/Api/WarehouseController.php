<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\WarehouseService;

/**
 * Author: Muhammadali
 * WarehouseController handles operations related to warehouses, utilizing the WarehouseService.
 */
class WarehouseController extends AbstractController
{
    /**
     * Constructor to initialize the WarehouseService.
     *
     * @param WarehouseService $service
     */
    public function __construct(WarehouseService $service){
        $this->service = $service;
    }
}
