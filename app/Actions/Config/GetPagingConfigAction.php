<?php

namespace App\Actions\Config;

use App\Cores\Abstracts\Action;
use App\Tasks\Config\GetPagingConfigTask;

class GetPagingConfigAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingConfigTask::class)->run($param);
    }
}