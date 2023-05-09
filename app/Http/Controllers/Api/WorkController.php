<?php

namespace App\Http\Controllers\Api;

use App\Actions\Works\FindWorkByIdAction;
use App\Actions\Works\GetListWorkAction;
use App\Actions\Works\GetPagingWorkAction;
use App\Actions\Works\GetRelateWorkAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkController extends Controller
{
    protected $column = ['id', 'title', 'slug', 'description', 'time', 'degree', 'object', 'course_category_id', 'image'];
    /**
    * @OA\Get(
    ** path="/works",
    *   tags={"Works"},
    *     security={
    *   },
    *       @OA\Parameter(
    *          name="search",
    *          in="query",
    *          description="Search",
    *          @OA\Schema(
    *              type="string"
    *          )
    *       ),
    *   @OA\Parameter(
    *      name="keyword",
    *      in="query",
    *      description="Keyword",
    *      @OA\Schema(
    *          type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="course_category_id",
    *      in="query",
    *      description="Course Category Id",
    *      @OA\Schema(
    *          type="integer"
    *      )
    *   ),
    *    @OA\Parameter(
    *       name="page",
    *       in="query",
    *       description="Page",
    *       @OA\Schema(
    *           type="integer"
    *       )
    *    ),
    *    @OA\Parameter(
    *       name="per_page",
    *       in="query",
    *       description="Per Page",
    *       @OA\Schema(
    *           type="integer"
    *       )
    *    ),
    *       @OA\Parameter(
    *          name="sortfield",
    *          in="query",
    *          description="Sort Field",
    *          @OA\Schema(
    *              type="string"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="sorttype",
    *          in="query",
    *          description="Sort Type",
    *          @OA\Schema(
    *              type="string"
    *          )
    *       ),
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
        $param = array(
            'limit' => 10,
            'sortfield' => 'id',
            'sorttype' => 'DESC'
        );

        if ($request->has('sortfield') && $request->has('sorttype')) {
            $param['sortfield'] = $request->get('sortfield');
            $param['sorttype'] = $request->get('sorttype');
        }

        if($request->has('search')){
            $param['search'] = $request->get('search');
        }

        if($request->has('course_category_id')){
            $param['course_category_id'] = $request->get('course_category_id');
        }

        if($request->has('keyword')){
            $param['keyword'] = $request->get('keyword');
        }

        if ($request->has('per_page') && $request->get('per_page') > 0) {
            $param['limit'] = $request->get('per_page');
        }   
        $works = resolve(GetPagingWorkAction::class)->run($param);
        return $this->sendResult(Response::HTTP_OK, trans('works.list'), $works['data'], $works['keywords']);
    }

    /**
    * @OA\Get(
    ** path="/works/detail/{id}",
    *   tags={"Works"},
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
    public function detail($id)
    {
        array_push($this->column, 'content', 'keyword');
        $work = resolve(FindWorkByIdAction::class)->run($id, $this->column);
        $work->courseCategory;
        return $this->sendResult(Response::HTTP_OK, trans('works.detail'), $work);
    } 

    /**
    * @OA\Get(
    ** path="/works/relate/{id}",
    *   tags={"Works"},
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
        $works = resolve(GetRelateWorkAction::class)->run($id, $this->column);
        return $this->sendResult(Response::HTTP_OK, trans('works.relate'), $works);
    }
}
