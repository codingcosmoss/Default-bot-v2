<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\DrugCompanyService;
use App\Services\Api\SizeTypeService;

class DrugCompanyController extends AbstractController
{
    public function __construct(DrugCompanyService $service){
        $this->service = $service;
    }


}
