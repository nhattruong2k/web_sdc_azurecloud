<?php

namespace App\Actions\Projectstudents;

use App\Cores\Abstracts\Action;
use App\Tasks\Projectstudents\FindProjectStudentByIdTask;

class FindProjectStudentByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindProjectStudentByIdTask::class)->run($id, $columns);
    }
}
