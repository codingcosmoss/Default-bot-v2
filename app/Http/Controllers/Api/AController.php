<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
class AController extends AbstractController
{
    public function __construct(AService $service){
        $this->service = $service;
    }

}
