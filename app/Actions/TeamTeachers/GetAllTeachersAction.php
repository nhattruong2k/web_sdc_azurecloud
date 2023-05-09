<?php
namespace App\Actions\TeamTeachers;
use App\Cores\Abstracts\Action;
use App\Tasks\TeamTeachers\GetAllTeachersTask;

class GetAllTeachersAction extends Action
{
    public function run(){
        return resolve(GetAllTeachersTask::class)->run();
    }
}
