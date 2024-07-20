<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MedicineCategoryService;
use App\Services\Api\SizeTypeService;

class MedicineCategoryController extends AbstractController
{
    public function __construct(MedicineCategoryService $service){
        $this->service = $service;
    }


}
