<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\InvoiceService;

class InvoiceController extends AbstractController
{
    public function __construct(InvoiceService $service){
        $this->service = $service;
    }

}
