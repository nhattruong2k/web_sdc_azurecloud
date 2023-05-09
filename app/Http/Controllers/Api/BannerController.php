<?php

namespace App\Http\Controllers\Api;

use App\Actions\Banners\GetAllBannerAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * @OA\Get(
     ** path="/banners",
     *   tags={"Banners"},
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
        $banner = resolve(GetAllBannerAction::class)->run(['title', 'link','url','description']);
        return $this->sendResult(Response::HTTP_OK, trans('banners.list'), $banner);
    }
}
