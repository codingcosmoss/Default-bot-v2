<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Author: Muhammadali
 * Controller is the base class for handling HTTP requests and responses.
 * It provides utility methods for generating success and error responses.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $ok = 200;
    public $created = 201;
    public $unAuthorized = 401;
    public $badRequest = 403;

    /**
     * Generate a success response with the given HTTP status code, message, and optional data.
     *
     * @param int $code HTTP status code
     * @param string $message Response message
     * @param mixed $data Optional response data
     * @return JsonResponse
     */
    public function success($code, $message, $data = null){
        return response()->json([
            'success' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Generate an error response with the given HTTP status code, message, and optional data.
     *
     * @param int $code HTTP status code
     * @param string $message Response message
     * @param mixed $data Optional response data
     * @return JsonResponse
     */
    public function error($code, $message, $data = null){
        return response()->json([
            'error' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
