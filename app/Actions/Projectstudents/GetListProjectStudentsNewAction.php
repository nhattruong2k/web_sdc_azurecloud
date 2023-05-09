<?php


namespace App\Actions\Projectstudents;


use App\Cores\Abstracts\Action;
use App\Tasks\Projectstudents\GetListProjectStudentsNewTask;

class GetListProjectStudentsNewAction extends Action
{
    public function run(){
        return resolve(GetListProjectStudentsNewTask::class)->run();
    }
}
