<?php
namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Tasks\FeelStudents\GetListFeelStudentTask;

class GetListFeelStudentAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetListFeelStudentTask::class)->run($column);
    }
}
