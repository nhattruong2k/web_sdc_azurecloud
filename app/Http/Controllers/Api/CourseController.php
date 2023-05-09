<?php

namespace App\Http\Controllers\Api;

use App\Actions\Courses\FindCourseByIdAction;
use App\Actions\Courses\GetAllCourseAction;
use App\Actions\Courses\GetAllCourseByCategoryAction;
use App\Actions\Courses\GetRelateCourseAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
    * @OA\Get(
    ** path="/courses",
    *   tags={"Courses"},
    *     security={
    *   },
    *   @OA\Parameter(
    *      name="keyword",
    *      in="query",
    *      description="keyword",
    *      @OA\Schema(
    *          type="string"
    *      )
    *   ),
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
        $column = ['id','title', 'slug', 'description', 'time', 'degree', 'object','course_category_id','image','keyword'];
        $courses = resolve(GetAllCourseAction::class)->run($request, $column);
        return $this->sendResult(Response::HTTP_OK, trans('courses.list'), $courses);
    }

    /**
    * @OA\Get(
    ** path="/courses/overview-courses",
    *   tags={"Courses"},
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
    public function overviewByCourseCategory(Request $request)
    {
        $column = ['id','title', 'slug', 'description', 'time', 'degree', 'object','course_category_id','image','keyword'];
        $param = array(
            'take' => 6,
            'sortfield' => 'id',
            'sorttype' => 'DESC'
        );
        $courses = resolve(GetAllCourseByCategoryAction::class)->run($param, $column);
        return $this->sendResult(Response::HTTP_OK, trans('courses.overview_by_catagory'), $courses);
    }

    /**
    * @OA\Get(
    ** path="/courses/detail/{id}",
    *   tags={"Courses"},
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
        $column = ['id','title', 'slug', 'content', 'description', 'time', 'degree', 'object','course_category_id','image', 'keyword'];
        $course = resolve(FindCourseByIdAction::class)->run($id, $column);
        $course->course_categories;
        return $this->sendResult(Response::HTTP_OK, trans('courses.detail'), $course);
    }

    /**
    * @OA\Get(
    ** path="/courses/relate/{id}",
    *   tags={"Courses"},
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
    public function relate($id){
        $columns = ['id','title','slug','description','time','degree','object','course_category_id','image'];
        $course = resolve(GetRelateCourseAction::class)->run($id, $columns);
        return $this->sendResult(Response::HTTP_OK, trans('courses.relate'), $course);
    }
}
