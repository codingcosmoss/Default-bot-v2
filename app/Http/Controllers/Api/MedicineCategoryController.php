<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MedicineCategoryService;
use App\Services\Api\SizeTypeService;

/**
 * Author: Muhammadali
 * MedicineCategoryController handles operations related to medicine categories.
 */
class MedicineCategoryController extends AbstractController
{
    /**
     * Constructor to initialize the MedicineCategoryService.
     *
     * @param MedicineCategoryService $service
     */
    public function __construct(MedicineCategoryService $service){
        $this->service = $service;
    }
}
