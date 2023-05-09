<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Documentation Api SDC",
 *     @OA\Contact(name="Phạm Thanh Tươi")
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendResult($code, $message, $data, $keyword = null)
    {
        $params = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'success' => true
        ];
        if ($keyword){
            $params += [
                'keywords' => $keyword
            ];
        }
        return response()->json($params);
    }

    public function sendError($code, $message)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'success' => false
        ]);
    }
}
