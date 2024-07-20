<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SizeTypeService;

class SizeTypeController extends AbstractController
{
    public function __construct(SizeTypeService $service){
        $this->service = $service;
    }


}
