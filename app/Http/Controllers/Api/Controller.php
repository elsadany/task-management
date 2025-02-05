<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;

        //Success Response
        public function successResponse($message = '', $data = [], $statusCode = Response::HTTP_OK)
        {
            return response()->json([
                'status' => true,
                'code' => $statusCode,
                'message' => $message,
                'data' => $data
            ], $statusCode);
        }

        //Error Response
        public function errorResponse($message = '', $statusCode = Response::HTTP_BAD_REQUEST)
        {
            return response()->json([
                'status' => false,
                'code' => $statusCode,
                'message' => $message,
            ],$statusCode);
        }

}
