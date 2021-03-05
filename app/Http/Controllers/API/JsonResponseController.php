<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JsonResponseController extends Controller
{
    public function successResponse($data, $message)
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function errorResponse($error, $messages = [], $code = null)
    {
        $response = [
            'response' => $error,
        ];

        if (count($messages) > 0) $response['message'] = $messages;

        return response()->json($response, $code);
    }
}