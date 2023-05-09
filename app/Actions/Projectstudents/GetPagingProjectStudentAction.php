<?php

namespace App\Actions\Projectstudents;

use App\Cores\Abstracts\Action;
use App\Tasks\Projectstudents\GetPagingProjectStudentTask;

class GetPagingProjectStudentAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingProjectStudentTask::class)->run($param);
    }
}