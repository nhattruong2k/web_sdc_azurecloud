<?php
namespace App\Actions\OpeningSchedules;

use App\Cores\Abstracts\Action;
use App\Tasks\OpeningSchedules\CheckExistOpeningScheduleTask;
use Illuminate\Http\Request;

class CheckExistOpeningScheduleAction extends Action
{
    public function run(Request $request){
        $course_id = trim($request->get("course_id"));
        $id = trim($request->get("id"));
        return resolve(CheckExistOpeningScheduleTask::class)->run($course_id, $id);
    }
}
