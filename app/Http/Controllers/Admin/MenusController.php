<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Menus\CheckExistTitleMenuAction;
use App\Actions\Menus\CreateMenuAction;
use App\Actions\Menus\DeleteMenuAction;
use App\Actions\Menus\FindMenuByIdAction;
use App\Actions\Menus\GetPagingMenuAction;
use App\Actions\Menus\GetTreeMenuAction;
use App\Actions\Menus\UpdateMenuAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenusRequest;
use App\Libs\Constants;
use App\Models\Menus;
use App\Repositories\Contracts\MenusRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenusController extends Controller
{
    use DeleteModelTrait;
    protected $_menusRepository;

    public function __construct(MenusRepository $repository) {
        $this->_menusRepository = $repository;
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
        $menus = resolve(GetPagingMenuAction::class)->run($param);
        $this->data['title'] = __('menus.list');
        $this->data['menus'] = $menus;
        return view('admin.menus.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menus();
        $menu['parent'] = resolve(GetTreeMenuAction::class)->run();
        $this->data['title'] = __('menus.create');
        $this->data['menu'] = $menu;
        return view('admin.menus.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(MenusRequest $request)
    {
        resolve(CreateMenuAction::class)->run($request);
        notify()->success(trans('menus.create_successfully'));
        return redirect()->route(Menus::LIST);
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
        $menu =  resolve(FindMenuByIdAction::class)->run($id);
        $menu['parent'] = resolve(GetTreeMenuAction::class)->run($id);
        $this->data['title'] = __('menus.update');
        $this->data['menu'] = $menu;
        return view('admin.menus.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenusRequest $request, $id)
    {
        resolve(UpdateMenuAction::class)->run($id, $request);
        notify()->success((trans('menus.update_successfully')));
        return redirect()->route(Menus::LIST);
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
        resolve(DeleteMenuAction::class)->run($ids);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request) {
        $user = resolve(FindMenuByIdAction::class)->run($request->get('id'), ['id', 'status']);
        $status = $user->status == Constants::$status['active'] ? Constants::$status['deactive'] : Constants::$status['active'];
        $this->_menusRepository->update(['status' => $status], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('menus.status_successfully')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titleExist (Request $request)
    {
        $result = resolve(CheckExistTitleMenuAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
