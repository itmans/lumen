<?php

namespace App\Http\Controllers;

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

}

