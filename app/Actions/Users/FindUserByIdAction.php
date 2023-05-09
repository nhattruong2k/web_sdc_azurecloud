<?php

namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\FindUserByIdTask;

class FindUserByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindUserByIdTask::class)->run($id, $columns);
    }
}
