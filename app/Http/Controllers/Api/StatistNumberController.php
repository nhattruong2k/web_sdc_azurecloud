<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Actions\statistNumbers\GetAllStatistNumbersAction;
class StatistNumberController extends Controller
{
    /**
     * @OA\Get(
     ** path="/statist-number",
     *   tags={"Statist Number"},
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
     *   @OA\Response(
     *       response=403,
     *       description="Forbidden"
     *   )
     *)
     **/
    public function index(){
        $statistNumber = resolve(GetAllStatistNumbersAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('statistnumber.list'), $statistNumber);
    }
}
