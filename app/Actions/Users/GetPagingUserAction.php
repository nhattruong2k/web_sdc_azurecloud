<?php

namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\GetPagingUserTask;

class GetPagingUserAction extends Action
{

    public function run(array $param)
    {
        return resolve(GetPagingUserTask::class)->run($param);
    }
}
