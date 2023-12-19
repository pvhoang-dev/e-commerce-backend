<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param $message
     * @param array $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message, $option = [])
    {
        return Response::json([
            'status' => "error",
            'code' => data_get($option, "error_code", 1),
            'message' => $message,
            'data' => data_get($option, "data", [])
        ], data_get($option, "status_code", 400));
    }

    /**
     * @param $message
     * @param array $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendFail($message, $option = [])
    {
        return Response::json([
            'status' => "fail",
            'code' => data_get($option, "error_code", 1),
            'message' => $message,
            'data' => data_get($option, "data", [])
        ], data_get($option, "status_code", 400));
    }

    /**
     * @param array $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data = [], $message = "")
    {
        return Response::json([
            'status' => "success",
            'code' => 0,
            'message' => $message,
            'data' => $data
        ], 200);
    }
}
