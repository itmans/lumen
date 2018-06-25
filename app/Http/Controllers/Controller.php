<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{



    /**
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $code = 0)
    {
        return response()->json([
            'code' => $code,
            'data' => $data
        ])->send();
    }

    /**
     * @param $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($msg, $code = 0)
    {
        return response()->json([
            'code' => $code,
            'msg' => $msg
        ])->send();
    }

    /**
     * @param Request $request
     * @param $rules
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function validators(Request $request, $rules, $message)
    {
        $validate = Validator($request->all(), $rules, $message);
        if ($validate->fails()) {
            return $this->error(array_values($validate->errors()->toArray())[0][0], 1000);
        }
    }
}

