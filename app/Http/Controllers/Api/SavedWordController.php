<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ExpressionService;
use App\Services\Api\PhraseService;
use App\Services\Api\SavedWordService;

class SavedWordController extends AbstractController
{
    public function __construct(
        protected SavedWordService $savedWordService
    ){}

    public function index()
    {
        $item = $this->savedWordService->index(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function show($id)
    {
        $item = $this->savedWordService->show($id);
        return $this->sendResponse($item);
    }

    public function showFirst()
    {
        $item = $this->savedWordService->showFirst();
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->savedWordService->store(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $item = $this->savedWordService->update(request()->all(), $id);
        return $this->sendResponse($item);
    }


    public function delete($id)
    {
        $item = $this->savedWordService->destroy($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $item = $this->savedWordService->search(request()->all());
        return $this->sendResponse($item);
    }





}
