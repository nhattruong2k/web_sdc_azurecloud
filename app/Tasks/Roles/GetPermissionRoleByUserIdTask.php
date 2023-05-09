<?php

namespace App\Tasks\Roles;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\UserRoleRepository;
use App\Exceptions\NotFoundException;
use Exception;
use Illuminate\Support\Facades\DB;

class GetPermissionRoleByUserIdTask extends Task
{
    protected UserRoleRepository $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository) {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function run(int $id)
    {
        try {
            $columns = [
                DB::raw('permissions.*')
            ];
            $permissionRoles = $this->userRoleRepository->select($columns)
                ->leftJoin('permission_roles', 'permission_roles.role_id', '=', 'user_roles.role_id')
                ->leftJoin('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
                ->whereUserId($id)->get();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $permissionRoles;
    }
}
