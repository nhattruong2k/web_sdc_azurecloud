<?php

namespace App\Tasks\Roles;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\RolesRepository;
use App\Exceptions\NotFoundException;
use Exception;

class FindRoleByIdTask extends Task
{
    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $role = $this->roleRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $role;
    }
}
