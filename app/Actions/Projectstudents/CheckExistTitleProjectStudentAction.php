<?php


namespace App\Actions\Projectstudents;

use App\Tasks\Projectstudents\CheckExistTitleProjectStudentTask;
use Illuminate\Http\Request;

class CheckExistTitleProjectStudentAction
{
    public function run(Request $request){
        $key = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleProjectStudentTask::class)->run($key, $id);
    }
}
