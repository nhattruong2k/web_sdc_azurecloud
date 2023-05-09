<?php

namespace App\Http\Controllers\Api;

use App\Actions\FeelStudents\GetListFeelStudentAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeelStudentController extends Controller
{
    /**
     * @OA\Get(
     ** path="/feel-students",
     *   tags={"Feel Students"},
     *     security={
     *   },
    *    summary="List",
    *    description="List",
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
        $feelStudents = resolve(GetListFeelStudentAction::class)->run(['id', 'name', 'avatar', 'content']);
        return $this->sendResult(Response::HTTP_OK, trans('feel_students.list'), $feelStudents);
    }
}
