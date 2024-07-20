<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\BoxSizeService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SizeTypeService;

class BoxSizeController extends AbstractController
{
    public function __construct(BoxSizeService $service){
        $this->service = $service;
    }


}
