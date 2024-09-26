<?php
namespace App\Http\Controllers\Api;

use App\Services\Api\AService;
use App\Services\Api\ClinicUserService;
use App\Services\Api\DocumentService;

/**

     * Author: Muhammadali

     * DocumentController Account invoices for imported drugs

 **/

class DocumentController extends AbstractController
{
    /**
     * Constructor to initialize the DocumentService.
     *
     * @param DocumentService $service
     */
    public function __construct(DocumentService $service){
        $this->service = $service;
    }

    /**
     * Create a new document and return the response.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all(), request());
        return $this->sendResponse($data);
    }

    /**
     * Update an existing document by ID and return the response.
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id, request());
        return $this->sendResponse($data);
    }
}
