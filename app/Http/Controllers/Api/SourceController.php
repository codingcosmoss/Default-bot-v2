<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ExpressionService;
use App\Services\Api\PhraseService;
use App\Services\Api\SourceService;

class SourceController extends AbstractController
{
    public function __construct(
        protected SourceService $sourceService
    ){}

    public function index()
    {
        $item = $this->sourceService->index(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function show($id)
    {
        $item = $this->sourceService->show($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->sourceService->store(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $item = $this->sourceService->update(request()->all(), $id);
        return $this->sendResponse($item);
    }


    public function delete($id)
    {
        $item = $this->sourceService->destroy($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $item = $this->sourceService->search(request()->all());
        return $this->sendResponse($item);
    }





}
