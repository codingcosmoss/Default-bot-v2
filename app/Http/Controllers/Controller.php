<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public  $ok = 200;
    public  $created = 201;
    public  $unAuthorized = 401;
    public  $badRequest = 403;



    public  function success($code, $message, $data = null){
        return response()->json([
            'success' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public  function error($code, $message, $data = null){
        return response()->json([
            'error' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }


}
