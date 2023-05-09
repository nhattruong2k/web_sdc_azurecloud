<?php

namespace App\Tasks\Roles;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\RolesRepository;

class GetPagingRoleTask extends Task
{

    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'roles.id',
            'roles.name',
            'roles.description',
            'roles.is_visible',
        ];

        $roles = $this->roleRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('roles.name', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['is_visible'])) {
                $query->where('roles.is_visible', $param['is_visible']);
            }
            return $query;
        });
        $roles->orderBy($param['sortfield'], $param['sorttype']);
        return $roles->paginate($param['limit'], $columns);
    }
}
