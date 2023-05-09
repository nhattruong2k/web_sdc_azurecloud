<?php

namespace App\Http\Controllers\Api;

use App\Actions\Partners\GetAllPartnerAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PartnerController extends Controller
{
    /**
     * @OA\Get(
     ** path="/partners",
     *   tags={"Partners"},
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
    public function index(Request $request)
    {
        $partners = resolve(GetAllPartnerAction::class)->run(['title', 'image', 'description']);
        return $this->sendResult(Response::HTTP_OK, trans('partners.list'), $partners);
    }
}
