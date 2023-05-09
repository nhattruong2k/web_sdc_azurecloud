<?php


namespace App\Actions\Courses;


use App\Cores\Abstracts\Action;
use App\Tasks\Courses\CountCourseTask;

class CountCourseAction extends Action
{
    public function run(){
        return resolve(CountCourseTask::class)->run();
    }
}
