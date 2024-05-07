<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ExpressionService;
use App\Services\Api\PhraseService;

class PhraseController extends AbstractController
{
    public function __construct(
        protected PhraseService $phraseService
    ){}

    public function index()
    {
        $item = $this->phraseService->index();
        return $this->sendResponse($item);
    }




}
