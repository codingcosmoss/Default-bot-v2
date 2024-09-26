<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\ClinicUserService;

/**

     * Author: Muhammadali

     * ClinicUserController This controller is responsible for
    allocating users to several pharmacies (clinics).

 **/

class ClinicUserController extends AbstractController
{
    /**
     * Constructor to initialize the ClinicUserService.
     *
     * @param ClinicUserService $service
     */
    public function __construct(ClinicUserService $service){
        $this->service = $service;
    }
}
