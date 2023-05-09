<?php

namespace App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\Tasks\Menus\FindMenuByIdTask;

class FindMenuByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindMenuByIdTask::class)->run($id, $columns);
    }
}
