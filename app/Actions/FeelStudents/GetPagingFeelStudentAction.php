<?php

namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Tasks\FeelStudents\GetPagingFeelStudentTask;

class GetPagingFeelStudentAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingFeelStudentTask::class)->run($param);
    }
}