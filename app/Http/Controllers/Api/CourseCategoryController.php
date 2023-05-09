<?php

namespace App\Http\Controllers\Api;

use App\Actions\CourseCategories\GetTreeCourseCategoryAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CourseCategoryController extends Controller
{
    /**
     * @OA\Get(
     ** path="/course-categories",
     *   tags={"Course Categories"},
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
        $course_categories = resolve(GetTreeCourseCategoryAction::class)->getTree();
        return $this->sendResult(Response::HTTP_OK, trans('course_categories.list'), $course_categories);
    }
}
