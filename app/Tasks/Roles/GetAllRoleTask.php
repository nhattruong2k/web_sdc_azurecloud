<?php


namespace App\Tasks\Roles;
use App\Repositories\Contracts\RolesRepository;

class GetAllRoleTask
{
    protected RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function run(array $columns = ['*'])
    {
        return $this->roleRepository->active()->select($columns)->get();
    }
}
