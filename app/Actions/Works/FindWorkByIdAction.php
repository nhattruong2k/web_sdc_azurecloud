<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Tasks\Works\FindWorkByIdTask;

class FindWorkByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindWorkByIdTask::class)->run($id, $columns);
    }
}
