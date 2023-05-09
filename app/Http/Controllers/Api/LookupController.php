<?php

namespace App\Http\Controllers\Api;

use App\Actions\Lookups\GetDiplomaLookupAction;
use App\Actions\Lookups\GetPointLookupAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lookup\DiplomasRequest;
use App\Http\Requests\Lookup\PointRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LookupController extends Controller
{
    /**
    * @OA\Get(
    *      path="/lookup/point",
    *      operationId="get_point",
    *      tags={"Lookup"},
    *       @OA\Parameter(
    *          name="type",
    *          in="query",
    *          required=true,
    *          description="1: Cơ bản; 2: Nâng cao",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="key",
    *          in="query",
    *          required=true,
    *          description="Key (1: Mã học viên; 2: CMND; 3: Họ tên; 4: Ngày sinh)",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="value",
    *          in="query",
    *          required=true,
    *          description="Value",
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
    public function point(PointRequest $request){
        $point = resolve(GetPointLookupAction::class)->run($request);
        return $this->sendResult(Response::HTTP_OK, 'point', $point);
    }

    /**
    * @OA\Get(
    *      path="/lookup/diplomas",
    *      operationId="get_diplomas",
    *      tags={"Lookup"},
    *       @OA\Parameter(
    *          name="type",
    *          in="query",
    *          required=true,
    *          description="1: Cơ bản; 2: Nâng cao",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="name",
    *          in="query",
    *          required=true,
    *          description="Họ và tên",
    *          @OA\Schema(
    *              type="string"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="ngaysinh",
    *          in="query",
    *          required=true,
    *          description="Ngày sinh",
    *          @OA\Schema(
    *              type="string"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="key",
    *          in="query",
    *          description="Key (1: Số hiệu CC; 2: CMNN; 3: Số vào sổ; 4: Khóa thi: 5: Quyết định)",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *       ),
    *       @OA\Parameter(
    *          name="value",
    *          in="query",
    *          description="Value",
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
    public function diplomas(DiplomasRequest $request){
        $diplomas = resolve(GetDiplomaLookupAction::class)->run($request);
        return $this->sendResult(Response::HTTP_OK, 'diplomas', $diplomas);
    }
}
