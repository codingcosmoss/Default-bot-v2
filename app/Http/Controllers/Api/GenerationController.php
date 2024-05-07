<?php

namespace App\Http\Controllers\Api;
use App\Services\Api\ExpressionService;
use App\Services\Api\GenerationService;

class GenerationController extends AbstractController
{
    public function __construct(
        // Gapning ifoda maqsadiga ko'ra 4 qisimga bo'luvchi va sintaktik tahlil qiluvchi service
        protected ExpressionService $expressionService
    ){}


    // Gapning ifoda maqsadiga ko'ra turini aniqlash
    public function expression()
    {
        //gap
        $talk = request()->all();

        // Kesimni aniqlash
        $kesim = $this->expressionService->hasKesim($talk);

        return $this->sendResponse($kesim);
    }



}
