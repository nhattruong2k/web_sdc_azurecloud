<?php


namespace App\Actions\Courses;


use App\Cores\Abstracts\Action;
use App\Tasks\Courses\FindCourseByFieldTask;

class FindCourseByFieldAction extends Action
{
    public function run($field, $value){
        return resolve(FindCourseByFieldTask::class)->run($field, $value);
    }
}
