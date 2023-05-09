<?php

namespace App\Http\Controllers\Api;

use App\Actions\GeneralSettings\FindSettingAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    /**
    * @OA\Get(
    ** path="/settings",
    *   tags={"Settings"},
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
        $setting = resolve(FindSettingAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('general_settings.management'), $setting);
    }
}
