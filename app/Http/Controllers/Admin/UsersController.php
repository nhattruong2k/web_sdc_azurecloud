<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Permissions\GetAllPermissionAction;
use App\Actions\Products\DestroyProductImageAction;
use App\Actions\Roles\GetAllRoleAction;
use App\Actions\Roles\GetPermissionRoleByUserIdAction;
use App\Actions\Users\CheckExistEmailAction;
use App\Actions\Users\CheckExistUsernameAction;
use App\Actions\Users\CreateUserAction;
use App\Actions\Users\CreateUserPermissionAction;
use App\Actions\Users\DestroyUserImageAction;
use App\Actions\Users\FindUserByIdAction;
use App\Actions\Users\GetPagingUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Libs\Constants;
use App\Models\User;
use App\Models\UserRole;
use App\Repositories\Contracts\UsersRepository;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use DeleteModelTrait;
    protected $_userRepository;
    protected $userRole;

    public function __construct(UsersRepository $repository, UserRole $userRole) {
        $this->_userRepository = $repository;
        $this->userRole = $userRole;
    }

    public function index(Request$request)
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
        $users = resolve(GetPagingUserAction::class)->run($param);
        $this->data['title'] = __('users.list');
        $this->data['users'] = $users;
        return view('admin.users.index')->with($this->data);
    }
    public function create(){
        $user = new User();
        $roles = resolve(GetAllRoleAction::class)->run(['name', 'id']);
        $this->data['title'] = __('users.create');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        return view('admin.users.create')->with($this->data);
    }

    public function store(UserRequest $request){
        resolve(CreateUserAction::class)->run($request);
        notify()->success(trans('users.create_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.create"), trans("users.create"), $request->all());
        return redirect(route(User::LIST));
    }

    public function edit($id){
        $user =  resolve(FindUserByIdAction::class)->run($id);
        $roles = resolve(GetAllRoleAction::class)->run(['name', 'id']);
        $roleOfUser = $user->roles;
        $this->data['title'] = __('users.update');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        $this->data['roleOfUser'] = $roleOfUser;
        return view('admin.users.edit')->with($this->data);
    }

    public function update(UserRequest $request, $id){
        resolve(UpdateUserAction::class)->run($id, $request);
        notify()->success(trans('users.update_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.update"), trans("users.update"), $request->all());
        return redirect(route(User::LIST));
    }

    public function destroy(Request $request) {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->deleteModelTrait($this->_userRepository,$ids);
        $this->userRole->whereIn('user_id', $arr_ids)->delete();
        notify()->success(trans('users.delete_successfully'));
        LogActivity::addToLog(auth()->user()->name. ' ' . trans("common.delete"), trans("users.delete"));
        return redirect()->back();
    }

    public function profile(){
        $id = Auth::user()->id;
        $user =  resolve(FindUserByIdAction::class)->run($id);
        $roles = resolve(GetAllRoleAction::class)->run(['name', 'id']);
        $roleOfUser = $user->roles;
        $this->data['title'] = __('users.profile');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        $this->data['roleOfUser'] = $roleOfUser;
        return view('admin.users.profile')->with($this->data);
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        resolve(UpdateUserAction::class)->run($id, $request);
        notify()->success(trans('users.update_profile_successfully'));
        return redirect(route('profile'));
    }

    public function active(Request $request) {
        $user = resolve(FindUserByIdAction::class)->run($request->get('id'), ['id', 'is_visible']);
        $is_visible = $user->is_visible == Constants::$is_visible['active'] ? Constants::$is_visible['deactive'] : Constants::$is_visible['active'];
        $this->_userRepository->update(['is_visible' => $is_visible], $request->get("id"));
        return response()->json(["code" => Response::HTTP_OK, "message" => __('users.status_successfully')]);
    }

    public function emailExist(Request $request) {
        $result = resolve(CheckExistEmailAction::class)->run($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function usernameExist(Request $request) {
        $result = resolve(CheckExistUsernameAction::class)->run($request);
        $code = Response::HTTP_OK;
        $message = 'success';
        if($result){
            $code = Response::HTTP_BAD_REQUEST;
            $message = __('users.username_exist');
        };
        return response()->json(["valid" => !$result, 'code' => $code, 'message' => $message]);
    }

    public function changePassword() {
        $this->data['title'] = __('users.change_password');
        return view('admin.auth.passwords.change_password')->with($this->data)->with(['code' => Response::HTTP_OK, 'message' => __('users.change_password')]);
    }

    /**
     * Handle change passord
     *
     * @param Request $request
     * @return type
     */
    public function saveChangePassword(Request $request) {
        $data = $request->all();
        $currentPassword = Auth::User()->password;
        if (Hash::check($data['old_password'], $currentPassword)) {
            $userId = Auth::User()->id;
            $objUser = $this->_userRepository->find($userId);
            $objUser->password = bcrypt($data['new_password']);
            $objUser->save();
            notify()->success(trans('users.change_pass_success'));
            return redirect()->back();
        } else {
            notify()->error(trans('users.old_pass_not_is_correct'));
            return redirect()->back();
        }

        return redirect(route('changePassword'));
    }

    public function permission($id)
    {
        $user =  resolve(FindUserByIdAction::class)->run($id);
        $permissions = resolve(GetAllPermissionAction::class)->run();
        $permissionsRoleChecked = resolve(GetPermissionRoleByUserIdAction::class)->run($id);
        $permissionUserChecked = $user->permissions;
        $this->data['title'] = __('users.permission');
        $this->data['user'] = $user;
        $this->data['permissions'] = $permissions;
        $this->data['permissionsRoleChecked'] = $permissionsRoleChecked;
        $this->data['permissionUserChecked'] = $permissionUserChecked;
        return view('admin.users.permission')->with($this->data);
    }

    public function savePermission(Request $request, $id)
    {
        resolve(CreateUserPermissionAction::class)->run($request, $id);
        notify()->success(trans('users.create_permission_successfully'));
        return redirect(route(User::LIST));
    }

    public function userChangePass($id){
        $title = __('users.change_password');
        $this->data['title'] = $title;
        $this->data['id'] = $id;
        notify()->success(trans('users.change_password'));
        return view('admin.users.change_password')->with($this->data);
    }

    public function saveUserChangePass(Request $request, $id){
        $user = resolve(FindUserByIdAction::class)->run($id, ['id']);
        if ($user){
            $data['password'] = bcrypt($request->get('new_password'));
            $user->update($data);
            notify()->success(trans('users.change_pass_success'));
            return redirect(route(User::LIST));
        }
        notify()->error(trans('users.change_pass_fail'));
        return redirect(route(User::LIST));
    }

    public function deleteImg($id, $imageName){
        resolve(DestroyUserImageAction::class)->run($id, $imageName);
        return redirect()->back();
    }
}
