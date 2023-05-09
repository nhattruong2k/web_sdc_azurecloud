<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Benefits\CheckExistTitleBenefitStudentAction;
use App\Actions\Benefits\CreateBenefitStudentAction;
use App\Actions\Benefits\DestroyImageBenefitsAction;
use App\Actions\Benefits\FindBenefitStudentByIdAction;
use App\Actions\Benefits\GetPagingBenefitStudentAction;
use App\Actions\Benefits\UpdateBenefitStudentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BenefitRequest;
use App\Libs\Constants;
use App\Models\Benefit;
use App\Repositories\Contracts\BenefitsRepository;
use App\Tasks\Benefits\FindBenefitStudentByIdTask;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BenefitController extends Controller
{
    use DeleteModelTrait;
    protected $_benefitsRepository;

    public function __construct(BenefitsRepository $repository)
    {
        $this->_benefitsRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        if ($request->has('search')) {
            $param['search'] = $request->get('search');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }
        $benefitStudents = resolve(GetPagingBenefitStudentAction::class)->run($param);
        $this->data['title'] = __('benefits.list');
        $this->data['benefitStudents'] = $benefitStudents;
        return view('admin.benefits.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $benefit = new Benefit();
        $this->data['title'] = __('benefits.create');
        $this->data['benefit'] = $benefit;
        return view('admin.benefits.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BenefitRequest $request)
    {
        resolve(CreateBenefitStudentAction::class)->run($request);
        notify()->success(trans('benefits.create_successfully'));
        return redirect()->route(Benefit::LIST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benefit = resolve(FindBenefitStudentByIdAction::class)->run($id);
        $this->data['title'] = __('benefits.update');
        $this->data['benefit'] = $benefit;
        return view('admin.benefits.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BenefitRequest $request, $id)
    {
        resolve(UpdateBenefitStudentAction::class)->run($id, $request);
        notify()->success((trans('benefits.update_successfully')));
        return redirect()->route(Benefit::LIST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $this->deleteModelTrait($this->_benefitsRepository, $ids);
        notify()->success((trans('benefits.delete_successfully')));
        return redirect()->back();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $benefitStudent = resolve(FindBenefitStudentByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $benefitStudent->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_benefitsRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('benefits.status_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titleExist (Request $request)
    {
        $result = resolve(CheckExistTitleBenefitStudentAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName, $type){
        resolve(DestroyImageBenefitsAction::class)->run($id, $imageName, $type);
        return redirect()->back();
    }
}
