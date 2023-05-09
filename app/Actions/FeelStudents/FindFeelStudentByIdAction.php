<?php

namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Tasks\FeelStudents\FindFeelStudentByIdTask;

class FindFeelStudentByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindFeelStudentByIdTask::class)->run($id, $columns);
    }
}
