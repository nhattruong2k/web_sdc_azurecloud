<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Roles\FindRoleByIdTask;

class FindRoleByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindRoleByIdTask::class)->run($id, $columns);
    }
}
