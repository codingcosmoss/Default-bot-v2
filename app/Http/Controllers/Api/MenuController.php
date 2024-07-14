<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MenuService;

class MenuController extends AbstractController
{
    public function __construct(MenuService $service){
        $this->service = $service;
    }

}
