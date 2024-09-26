<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\DrugCompanyService;
use App\Services\Api\SizeTypeService;

/**
     * Author: Muhammadali
     * Controller for managing drug companies, extends base functionality from AbstractController.
 **/

class DrugCompanyController extends AbstractController
{
    /**
     * Constructor for initializing the DrugCompanyService.
     *
     * @param DrugCompanyService $service
     **/
    public function __construct(DrugCompanyService $service){
        $this->service = $service;
    }
}

