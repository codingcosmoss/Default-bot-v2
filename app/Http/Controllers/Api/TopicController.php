<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ExpressionService;
use App\Services\Api\PhraseService;
use App\Services\Api\TopicService;

class TopicController extends AbstractController
{
    public function __construct(
        protected TopicService $topicService
    ){}

    public function index()
    {
        $item = $this->topicService->index(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function show($id)
    {
        $item = $this->topicService->show($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->topicService->store(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $item = $this->topicService->update(request()->all(), $id);
        return $this->sendResponse($item);
    }


    public function delete($id)
    {
        $item = $this->topicService->destroy($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $item = $this->topicService->search(request()->all());
        return $this->sendResponse($item);
    }





}
