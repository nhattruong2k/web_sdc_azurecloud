<?php


namespace App\Tasks\Roles;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\RolesRepository;


class CheckExistRoleNameTask extends Task
{
    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function run($name, $id = null)
    {
        return $this->roleRepository->scopeQuery(function ($query) use($name, $id) {
            $query = $query->whereName($name);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
