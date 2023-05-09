<?php

namespace App\Http\Controllers\Api;


use App\Models\Course;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Actions\Consultations\GetConsultationAction;
use App\Actions\Consultations\CreateConsultationAction;

class ConsultationController extends Controller
{
    /**
    * @OA\Post(
    ** path="/consultations/store",
    *   tags={"Consultation"},
    *   summary="Store",
    *   operationId="consultations_store",
    *
    *  @OA\RequestBody(
    *     @OA\MediaType(
    *      mediaType="multipart/form-data",
    *      mediaType="application/json",
    *          @OA\Schema(
    *              @OA\Property(
    *                  property="name",
    *                  example="Nguyễn Văn A",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="email",
    *                  example="email@gmail.com",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="phone",
    *                  example="0975352545",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="address",
    *                  example="Hải Châu 2, Hải Châu, Đà Nẵng",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="year_of_birth",
    *                  example="2000",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="ip_address",
    *                  example="101.99.53.144",
    *                  type="string",
    *              ),
    *              @OA\Property(
    *                  property="course_id",
    *                  example="1",
    *                  type="integer",
    *              ),
    *          ),
    *     ),
    *   ),
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
    public function store(ConsultationRequest $request){
        $course = Course::find($request["course_id"]);
        if(!empty($course)){
            $consultation = resolve(GetConsultationAction::class)->run($request);
            if(!is_null($consultation)){
                return $this->sendResult(Response::HTTP_OK, trans('consultations.create_successfully'), true);
            }else{
                resolve(CreateConsultationAction::class)->run($request);
                return $this->sendResult(Response::HTTP_OK, trans('consultations.create_successfully'), true);
            }
        }
        return $this->sendResult(Response::HTTP_NOT_FOUND, trans('consultations.course_notempty'), false);
    }
}
