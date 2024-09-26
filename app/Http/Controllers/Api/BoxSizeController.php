<?php
namespace App\Http\Controllers\Api;

use App\Models\SizeType;
use App\Services\Api\AService;
use App\Services\Api\BoxSizeService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\SizeTypeService;


/**

     * Author: Muhammadali
     * BoxSizeController manages operations related to box sizes, using the BoxSizeService.

 */
class BoxSizeController extends AbstractController
{
    /**
     * Constructor to initialize the BoxSizeService.
     *
     * @param BoxSizeService $service
     */
    public function __construct(BoxSizeService $service){
        $this->service = $service;
    }
}

