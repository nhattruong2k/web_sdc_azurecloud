<?php


namespace App\Actions\TeamStudents;


use App\Cores\Abstracts\Action;
use App\Tasks\TeamStudents\GetAllStudentTask;

class GetAllStudentAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetAllStudentTask::class)->run($column);
    }
}
