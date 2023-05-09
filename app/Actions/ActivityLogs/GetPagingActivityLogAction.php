<?php

namespace App\Actions\ActivityLogs;

use App\Cores\Abstracts\Action;
use App\Tasks\ActivityLogs\GetPagingActivityLogTask;

class GetPagingActivityLogAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingActivityLogTask::class)->run($param);
    }
}