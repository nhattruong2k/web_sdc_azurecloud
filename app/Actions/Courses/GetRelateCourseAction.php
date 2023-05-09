<?php


namespace App\Actions\Courses;


use App\Cores\Abstracts\Action;
use App\Tasks\Courses\FindCourseByIdTask;
use App\Tasks\Courses\GetRelateCourseTask;

class GetRelateCourseAction extends Action
{
    public function run($id, $columns = ['*']){
        $course = resolve(FindCourseByIdTask::class)->run($id);
        $relates = resolve(GetRelateCourseTask::class)->run($course->course_category_id, $id, $columns);
        return $relates;
    }
}
