<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SizeTypeService;

/**
 * Author: Muhammadali
 * SizeTypeController manages operations related to size types.
 */
class SizeTypeController extends AbstractController
{
    /**
     * Constructor to initialize the SizeTypeService.
     *
     * @param SizeTypeService $service
     */
    public function __construct(SizeTypeService $service){
        $this->service = $service;
    }
}

