<?php

namespace App\Tasks\Roles;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\RolesRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class CreateRoleTask extends Task
{

    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(array $data)
    {
        try {
            $role = $this->roleRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('roles.create_error'));
        }
        return $role;
    }
}
