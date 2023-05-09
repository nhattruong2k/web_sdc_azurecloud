<?php

namespace App\Http\Controllers\Api;

use App\Actions\Services\GetAllServiceAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ServiceController extends Controller
{

    /**
    * @OA\Get(
    ** path="/services",
    *   tags={"Services"},
    *     security={
    *   },
    *
    *   @OA\Response(
    *      response=200,
    *       description="Success",
    *      @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *   ),
    *   @OA\Response(
    *      response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *      response=400,
    *      description="Bad Request"
    *   ),
    *   @OA\Response(
    *      response=404,
    *      description="not found"
    *   ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *)
    **/
    public function index(){
        $services = resolve(GetAllServiceAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('services.list'), $services);
    }
}
