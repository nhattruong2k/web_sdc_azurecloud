<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Partners\CheckExistTitlePartnerAction;
use App\Actions\Partners\CreatePartnerAction;
use App\Actions\Partners\DestroyImagePartnersAction;
use App\Actions\Partners\FindPartnerByIdAction;
use App\Actions\Partners\GetPagingPartnerAction;
use App\Actions\Partners\UpdatePartnerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Libs\Constants;
use App\Models\Partners;
use App\Repositories\Contracts\PartnersRepository;
use App\Tasks\Partners\FindPartnerByIdTask;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PartnersController extends Controller
{
    use DeleteModelTrait;
    protected $_partnersRepository;

    public function __construct(PartnersRepository $repository)
    {
        $this->_partnersRepository = $repository;
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
        $partners = resolve(GetPagingPartnerAction::class)->run($param);
        $this->data['title'] = __('partners.list');
        $this->data['partners'] = $partners;
        return view('admin.partners.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = new Partners();
        $this->data['title'] = __('partners.create');
        $this->data['partner'] = $partner;
        return view('admin.partners.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        resolve(CreatePartnerAction::class)->run($request);
        notify()->success(trans('partners.create_successfully'));
        return redirect()->route(Partners::LIST);
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
        $partner = resolve(FindPartnerByIdAction::class)->run($id);
        $this->data['title'] = __('partners.update');
        $this->data['partner'] = $partner;
        return view('admin.partners.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, $id)
    {
        resolve(UpdatePartnerAction::class)->run($id, $request);
        notify()->success((trans('partners.update_successfully')));
        return redirect()->route(Partners::LIST);
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
        $this->deleteModelTrait($this->_partnersRepository, $ids);
        notify()->success((trans('partners.delete_successfully')));
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
        $partner = resolve(FindPartnerByIdTask::class)->run($request->get('id'), ['id', 'status']);
        $status = $partner->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_partnersRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('partners.status_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titleExist (Request $request)
    {
        $result = resolve(CheckExistTitlePartnerAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyImagePartnersAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
