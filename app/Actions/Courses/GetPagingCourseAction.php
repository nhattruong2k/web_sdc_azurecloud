<?php

namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Tasks\Courses\GetPagingCourseTask;

class GetPagingCourseAction extends Action
{

    public function run(array $param)
    {
        return resolve(GetPagingCourseTask::class)->run($param);
    }
}
