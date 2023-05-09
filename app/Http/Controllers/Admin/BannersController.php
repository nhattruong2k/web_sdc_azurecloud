<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Banners\CheckExistTitleAction;
use App\Actions\Banners\CreateBannerAction;
use App\Actions\Banners\DestroyBannerImageAction;
use App\Actions\Banners\FindBannerByIdAction;
use App\Actions\Banners\GetListBannerAction;
use App\Actions\Banners\UpdateBannerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannersRequest;
use App\Libs\Constants;
use App\Models\Banners;
use App\Repositories\Contracts\BannersRepository;
use App\Tasks\Banners\FindBannerByIdTask;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannersController extends Controller
{
    use DeleteModelTrait;
    protected $_bannersRepository;

    public function __construct(BannersRepository $repository)
    {
        $this->_bannersRepository = $repository;
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
        $banners = resolve(GetListBannerAction::class)->run($param);
        $this->data['title'] = __('banners.list');
        $this->data['banners'] = $banners;
        return view('admin.banners.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = new Banners();
        $this->data['title'] = __('banners.create');
        $this->data['banner'] = $banner;
        return view('admin.banners.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannersRequest $request)
    {
        resolve(CreateBannerAction::class)->run($request);
        notify()->success(trans('banners.create_successfully'));
        return redirect()->route(Banners::LIST);
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
        $banner = resolve(FindBannerByIdAction::class)->run($id);
        $this->data['title'] = __('banners.update');
        $this->data['banner'] = $banner;
        return view('admin.banners.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannersRequest $request, $id)
    {
       resolve(UpdateBannerAction::class)->run($id, $request);
       notify()->success((trans('banners.update_successfully')));
       return redirect()->route(Banners::LIST);
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
        $this->deleteModelTrait($this->_bannersRepository, $ids);
        notify()->success((trans('banners.delete_successfully')));
        return redirect()->back();
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request) {
        $banner = resolve(FindBannerByIdTask::class)->run($request->get('id'), ['id', 'status']);
        $status = $banner->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_bannersRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('banners.status_successfully')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titleExist (Request $request)
    {
        $result = resolve(CheckExistTitleAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyBannerImageAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
