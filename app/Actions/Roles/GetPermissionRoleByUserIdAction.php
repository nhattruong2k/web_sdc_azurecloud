<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Roles\GetPermissionRoleByUserIdTask;

class GetPermissionRoleByUserIdAction extends Action
{
    public function run(int  $id)
    {
        return resolve(GetPermissionRoleByUserIdTask::class)->run($id);
    }
}
