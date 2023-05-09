<?php

namespace App\Actions\Config;

use App\Cores\Abstracts\Action;
use App\Tasks\Config\FindConfigByIdTask;

class FindConfigByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindConfigByIdTask::class)->run($id, $columns);
    }
}
