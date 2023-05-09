<?php

namespace App\Http\Controllers\Api;

use App\Actions\OpeningSchedules\FindOpeningScheduleByIdAction;
use App\Actions\OpeningSchedules\GetAllOpeningScheduleAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class OpeningScheduleController extends Controller
{
    /**
    * @OA\Get(
    ** path="/opening-schedules",
    *   tags={"Opening Schedules"},
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
        $column = ['id','course_id', 'lecturers','tuition','preferential_tuition','preferential_tuition','data'];
        $opening_schedules = resolve(GetAllOpeningScheduleAction::class)->run($column);
        return $this->sendResult(Response::HTTP_OK, trans('opening_schedules.list'), $opening_schedules);
    }

    /**
    * @OA\Get(
    ** path="/opening-schedules/detail/{id}",
    *   tags={"Opening Schedules"},
    *      @OA\Parameter(
    *          in="path",
    *          name="id",
    *          required=true,
    *          description="Id",
    *          @OA\Schema(
    *            type="integer"
    *          )
    *       ),
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
    public function detail($id){
        $column = ['id','course_id', 'lecturers','tuition','preferential_tuition','preferential_tuition','data'];
        $opening_schedule = resolve(FindOpeningScheduleByIdAction::class)->run($id, $column);
        return $this->sendResult(Response::HTTP_OK, trans('opening_schedules.detail'), $opening_schedule);
    }
}
