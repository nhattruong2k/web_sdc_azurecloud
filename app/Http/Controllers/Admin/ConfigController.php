<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Config\CheckExistKeyConfigAction;
use App\Actions\Config\CreateConfigAction;
use App\Actions\Config\FindConfigByIdAction;
use App\Actions\Config\GetPagingConfigAction;
use App\Actions\Config\UpdateConfigAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Libs\Constants;
use App\Models\Config;
use App\Repositories\Contracts\ConfigRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Cache;

class ConfigController extends Controller
{
    use DeleteModelTrait;
    protected $_configRepository;

    public function __construct(ConfigRepository $repository)
    {
        $this->_configRepository = $repository;
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
        $configs = resolve(GetPagingConfigAction::class)->run($param);
        $this->data['title'] = __('config.list');
        $this->data['configs'] = $configs;
        return view('admin.config.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config= new Config();
        $this->data['title'] = __('config.create');
        $this->data['config'] = $config;
        return view('admin.config.create')->with($this->data); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfigRequest $request)
    {
        resolve(CreateConfigAction::class)->run($request);
        notify()->success(trans('config.create_successfully'));
        return redirect()->route(Config::LIST);
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
        $config = resolve(FindConfigByIdAction::class)->run($id);
        $this->data['title'] = __('config.update');
        $this->data['config'] = $config;
        return view('admin.config.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigRequest $request, $id)
    {
        resolve(UpdateConfigAction::class)->run($id, $request);
        notify()->success((trans('config.update_successfully')));
        return redirect()->route(Config::LIST);
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
        $this->deleteModelTrait($this->_configRepository, $ids);
        Cache::delete(Constants::$fileName['configs']);
        notify()->success((trans('config.delete_successfully')));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request) {
        $config = resolve(FindConfigByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $config->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_configRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('config.status_successfully')]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function keyExist (Request $request)
    {
        $result = resolve(CheckExistKeyConfigAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
