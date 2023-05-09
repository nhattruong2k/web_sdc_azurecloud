<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\TeamStudents\GetAllStudentAction;
use App\Actions\TeamStudents\FindStudentsBySlugAction;

class StudentController extends Controller
{
    /**
     * @OA\Get(
     ** path="/students",
     *   tags={"Students"},
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
    public function index(Request $request)
    {
        $students = resolve(GetAllStudentAction::class)->run(['fullname','slug','avatar', 'position', 'workplace', 'description']);
        return $this->sendResult(Response::HTTP_OK, trans('student.list'), $students);
    }
    
     /**
     * @OA\Get(
     ** path="/students/detail/{slug}",
     *   tags={"Students"},
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
        $students = resolve(FindStudentsBySlugAction::class)->run($slug);
        return $this->sendResult(Response::HTTP_OK, trans('student.detail'), $students);
    }
}
