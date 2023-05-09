<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\TeamTeachers\GetAllTeachersAction;
use App\Actions\TeamTeachers\FindTeachersBySlugAction;

class TeacherController extends Controller
{
     /**
     * @OA\Get(
     ** path="/teachers",
     *   tags={"Teachers"},
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
    public function index(Request $request){
        $teachers = resolve(GetAllTeachersAction::class)->run();
        return $this->sendResult(Response::HTTP_OK, trans('teacher.list'), $teachers);
    }

         /**
     * @OA\Get(
     ** path="/teachers/detail/{slug}",
     *   tags={"Teachers"},
     *     security={
     *   },
     *      summary="Detail",
     *      description="detail",
     *      @OA\Parameter(
     *          in="path",
     *          name="slug",
     *          required=true,
     *          description="Slug",
     *          @OA\Schema(
     *            type="string"
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
     *   @OA\Response(
     *       response=403,
     *       description="Forbidden"
     *   )
     *)
     **/
    public function detail($slug){
        $teachers = resolve(FindTeachersBySlugAction::class)->run($slug);
        return $this->sendResult(Response::HTTP_OK, trans('teacher.detail'), $teachers);
    }
}
