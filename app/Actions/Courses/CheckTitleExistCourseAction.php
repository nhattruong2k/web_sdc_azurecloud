<?php


namespace App\Actions\Courses;


use App\Cores\Abstracts\Action;
use App\Tasks\Courses\CheckTitleExistCourseTask;
use Illuminate\Http\Request;

class CheckTitleExistCourseAction extends Action
{
    public function run(Request $request){
        $title = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckTitleExistCourseTask::class)->run($title, $id);
    }
}
