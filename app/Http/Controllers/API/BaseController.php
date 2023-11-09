<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller

{
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponseData($result, $message)
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'status' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function sendResponseMessage($message)
    {
        $response = [
            'status' => true,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}
