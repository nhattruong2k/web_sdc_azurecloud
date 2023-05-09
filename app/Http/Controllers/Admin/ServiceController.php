<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Services\CheckTitleExistServiceAction;
use App\Actions\Services\CreateServiceAction;
use App\Actions\Services\FindServiceByIdAction;
use App\Actions\Services\GetPagingServiceAction;
use App\Actions\Services\UpdateServiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Libs\Constants;
use App\Models\Service;
use App\Repositories\Contracts\ServiceRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    use DeleteModelTrait;
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

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
        $services = resolve(GetPagingServiceAction::class)->run($param);
        $this->data['title'] = __('services.list');
        $this->data['services'] = $services;
        return view('admin.services.index')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('services.list')]);
    }

    public function create()
    {
        $service = new Service();
        $this->data['title'] = __('services.create');
        $this->data['service'] = $service;
        return view('admin.services.create')->with($this->data);
    }

    public function store(ServiceRequest $request)
    {
        resolve(CreateServiceAction::class)->run($request);
        notify()->success(trans('services.create_successfully'));
        return redirect(route(Service::LIST));
    }

    public function edit($id)
    {
        $service =  resolve(FindServiceByIdAction::class)->run($id);
        $this->data['title'] = __('services.update');
        $this->data['service'] = $service;
        return view('admin.services.edit')->with($this->data);
    }

    public function update(ServiceRequest $request, $id)
    {
        resolve(UpdateServiceAction::class)->run($id, $request);
        notify()->success(trans('services.update_successfully'));
        return redirect(route(Service::LIST));
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $this->deleteModelTrait($this->serviceRepository,$ids);
        notify()->success(trans('services.delete_successfully'));
        return redirect()->back();
    }

    public function active(Request $request) {
        $service = resolve(FindServiceByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $service->status == Constants::$is_visible['active'] ? Constants::$is_visible['deactive'] : Constants::$is_visible['active'];
        $this->serviceRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('common.status_successfully')]);
    }

    public function titleExist(Request $request){
        $result = resolve(CheckTitleExistServiceAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
