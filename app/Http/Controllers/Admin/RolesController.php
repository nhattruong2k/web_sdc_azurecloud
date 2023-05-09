<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Permissions\GetAllPermissionAction;
use App\Actions\Roles\CheckExistRoleNameAction;
use App\Actions\Roles\CreateRoleAction;
use App\Actions\Roles\FindRoleByIdAction;
use App\Actions\Roles\GetPagingRoleAction;
use App\Actions\Roles\UpdateRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Libs\Constants;
use App\Models\Roles;
use App\Models\UserRole;
use App\Repositories\Contracts\RolesRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RolesController extends Controller
{
    use DeleteModelTrait;
    protected $_roleRepository;
    protected $_userRole;

    public function __construct(RolesRepository $_roleRepository, UserRole $_userRole)
    {
        $this->_roleRepository = $_roleRepository;
        $this->_userRole = $_userRole;
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
        $roles = resolve(GetPagingRoleAction::class)->run($param);
        $this->data['title'] = __('roles.list');
        $this->data['roles'] = $roles;
        return view('admin.roles.index')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('roles.list')]);
    }

    public function create()
    {
        $role = new Roles();
        $this->data['title'] = __('roles.create');
        $this->data['role'] = $role;
        $permissions = resolve(GetAllPermissionAction::class)->run();
        $this->data['permissions'] = $permissions;
        return view('admin.roles.create')->with($this->data);
    }

    public function store(RoleRequest $request)
    {
        resolve(CreateRoleAction::class)->run($request);
        notify()->success(trans('roles.create_successfully'));
        return redirect(route(Roles::LIST));
    }

    public function edit($id)
    {
        $role =  resolve(FindRoleByIdAction::class)->run($id);
        $permissionsChecked = $role->permissions;
        $permissions = resolve(GetAllPermissionAction::class)->run();
        $this->data['title'] = __('roles.update');
        $this->data['role'] = $role;
        $this->data['permissions'] = $permissions;
        $this->data['permissionsChecked'] = $permissionsChecked;
        return view('admin.roles.edit')->with($this->data)->with(['code' => Response::HTTP_OK,'message' => __('roles.update')]);
    }

    public function update(RoleRequest $request, $id)
    {
        resolve(UpdateRoleAction::class)->run($id, $request);
        notify()->success(trans('roles.update_successfully'));
        return redirect(route(Roles::LIST));
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $checkExist = $this->_userRole->whereIn('role_id', $arr_ids)->count();
        if ($checkExist === 0){
            $this->deleteModelTrait($this->_roleRepository,$ids);
            notify()->success(trans('roles.delete_successfully'));
            return redirect()->back();
        }
        notify()->error(trans('roles.exist_users'));
        return redirect()->back();
    }

    public function active(Request $request) {
        $user = resolve(FindRoleByIdAction::class)->run($request->get('id'), ['id', 'is_visible']);
        $is_visible = $user->is_visible == Constants::$is_visible['active'] ? Constants::$is_visible['deactive'] : Constants::$is_visible['active'];
        $this->_roleRepository->update(['is_visible' => $is_visible], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('roles.status_successfully')]);
    }

    public function nameExist(Request $request){
        $result = resolve(CheckExistRoleNameAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
