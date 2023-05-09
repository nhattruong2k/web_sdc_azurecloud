<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Roles\GetPagingRoleTask;

class GetPagingRoleAction extends Action
{

    public function run(array $param)
    {
        return resolve(GetPagingRoleTask::class)->run($param);
    }
}
