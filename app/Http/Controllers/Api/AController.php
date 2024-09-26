<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;

/**

     * Author: Muhammadali

     * When creating a new controller, a copy is taken from this controller.
    This controller contains the initial code template for the new controller

 **/

class AController extends AbstractController
{
    // AService => The service created for this controller
    public function __construct(AService $service){
        $this->service = $service;
    }

}
