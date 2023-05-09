<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Tasks\Works\FindWorkByIdTask;
use App\Tasks\Works\GetRelateWorkTask;

class GetRelateWorkAction extends Action
{
    public function run($id, $columns = ['*']){
        $course = resolve(FindWorkByIdTask::class)->run($id);
        $relates = resolve(GetRelateWorkTask::class)->run($course->course_category_id, $id, $columns);
        return $relates;
    }
}
