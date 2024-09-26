<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\MenuService;

/**
 * Author: Muhammadali
 * MenuController handles operations related to menu management.
 */
class MenuController extends AbstractController
{
    /**
     * Constructor to initialize the MenuService.
     *
     * @param MenuService $service
     */
    public function __construct(MenuService $service){
        $this->service = $service;
    }
}
