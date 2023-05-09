<?php

namespace App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\Tasks\Menus\GetPagingMenuTask;

class GetPagingMenuAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingMenuTask::class)->run($param);
    }
}