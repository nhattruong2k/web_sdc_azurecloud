<?php


namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Tasks\Courses\GetAllCourseTask;
use Illuminate\Http\Request;

class GetAllCourseAction extends Action
{
    public function run(Request $request, array $columns = ['*']){
        $params = $request->all();
        $courses = resolve(GetAllCourseTask::class)->run($params, $columns);
        return $courses;
    }
}
