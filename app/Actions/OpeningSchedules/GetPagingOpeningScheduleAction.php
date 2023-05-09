<?php

namespace App\Actions\OpeningSchedules;

use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\GetPagingOpeningScheduleTask;

class GetPagingOpeningScheduleAction extends Action
{

    public function run(array $param)
    {
        return resolve(GetPagingOpeningScheduleTask::class)->run($param);
    }
}
