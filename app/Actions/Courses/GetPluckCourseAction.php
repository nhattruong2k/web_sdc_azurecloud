<?php


namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Tasks\Courses\GetPluckCourseTask;

class GetPluckCourseAction extends Action
{
    public function run(){
        $courses = resolve(GetPluckCourseTask::class)->run();
        return ['' => __('common.choose')] + $courses->toArray();
    }
}
