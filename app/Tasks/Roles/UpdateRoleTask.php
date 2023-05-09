<?php

namespace App\Tasks\Roles;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateResourceFailedException;
use App\Repositories\Contracts\RolesRepository;
use Exception;
use App\Exceptions\InternalErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateRoleTask extends Task
{

    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function run($data, int $roleId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $role = $this->roleRepository->update($data, $roleId);
            return $role;
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('roles.update_error'));
        }

        return $role;
    }
}
