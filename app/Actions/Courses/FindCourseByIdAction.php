<?php

namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Tasks\Courses\FindCourseByIdTask;

class FindCourseByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        $course = resolve(FindCourseByIdTask::class)->run($id, $columns);
        return $course;
    }
}
