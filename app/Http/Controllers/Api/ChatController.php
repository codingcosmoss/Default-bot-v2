<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ChatService;


class ChatController extends AbstractController
{
    public function __construct(
        protected ChatService $chatService
    ){}

    public function sendMessage()
    {
        $item = $this->chatService->sendMessage(request()->all());
        return $this->sendResponse($item);
    }

    public function getMessages($id)
    {
        $item = $this->chatService->getMessages($id);
        return $this->sendResponse($item);
    }




}
