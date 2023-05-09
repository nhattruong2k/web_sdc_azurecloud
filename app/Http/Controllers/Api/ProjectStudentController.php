<?php

namespace App\Http\Controllers\Api;

use App\Actions\Projectstudents\GetListProjectStudentsNewAction;
use App\Actions\Projectstudents\GetPagingProjectStudentAction;
use App\Http\Controllers\Controller;
use App\Libs\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectStudentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/project-students",
     *      operationId="index-project",
     *      tags={"ProjectStudents"},
     *
     *      summary="List",
     *      description="List",
     *       @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="Keyword",
     *          @OA\Schema(
     *              type="string"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="per_page",
     *          in="query",
     *          description="Per Page",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *       @OA\Parameter(
     *          name="feature",
     *          in="query",
     *          description="Feature",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
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

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="not found"
     *      ),
     *  )
     */
    public function index(Request $request){
        $param = array(
            'limit' => 10,
            'sortfield' => 'id',
            'sorttype' => 'DESC'
        );

        if ($request->has('sortfield') && $request->has('sorttype')) {
            $param['sortfield'] = $request->get('sortfield');
            $param['sorttype'] = $request->get('sorttype');
        }

        if($request->has('key_word')){
            $param['search'] = $request->get('key_word');
        }

        if ($request->has('per_page') && $request->get('per_page') > 0) {
            $param['limit'] = $request->get('per_page');
        }

        $param['status'] = Constants::$status['active'];
        $projects = resolve(GetPagingProjectStudentAction::class)->run($param);
        return $this->sendResult(Response::HTTP_OK, trans('project_students.list'), $projects);
    }
}
