<?php

namespace App\Actions\Roles;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\DestroyUserByIdsTask;

class DestroyRoleAction extends Action
{
    public function run(string $ids)
    {
        $arr_ids = explode(",", $ids);
        return resolve(DestroyUserByIdsTask::class)->run($arr_ids);
    }
}
