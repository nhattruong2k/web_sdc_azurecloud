<?php


namespace App\Tasks\Permissions;
use App\Repositories\Contracts\PermissionsRepository;


class GetAllPermissionTask
{
    protected PermissionsRepository $permissionRepository;

    public function __construct(PermissionsRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function run()
    {
        return $this->permissionRepository->whereType('group')->get('*');
    }
}
