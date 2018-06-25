<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/6 0006
 * Time: 9:15
 */

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait
{

    /**
     * @param Request $request
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, \Exception $e) {
        switch (true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            case $this->isBadRequestException($e):
                $retval = $this->badRequest();
                break;
            default:
               $retval = $this->exceptions($e);
        }
        return $retval;
    }


    /**
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message='Bad request', $code = 400) {
        return $this->jsonResponse([
            'msg' => $message
        ], $code);
    }


    /**
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function exceptions($e, $code = 500) {
        return $this->jsonResponse([
            'msg' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' =>$e->getLine()
        ], $code);
    }


    /**
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message='Record not found', $code=404) {
        return $this->jsonResponse([
            'msg' => $message,
        ], $code);
    }


    /**
     * @param \Exception $e
     * @return bool
     */
    protected  function isModelNotFoundException(\Exception $e) {
        return $e instanceof ModelNotFoundException;
    }




    /**
     * @param \Exception $e
     * @return bool
     */
    protected function isBadRequestException(\Exception $e) {
        return $e instanceof NotFoundHttpException;
    }


    /**
     * @param array|null $payload
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $code = 404) {
        $payload = $payload ?: [];
        $payload['code'] = $code;
        return response()->json($payload, $code);
    }
}