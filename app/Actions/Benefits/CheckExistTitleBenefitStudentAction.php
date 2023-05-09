<?php


namespace App\Actions\Benefits;

use App\Tasks\Benefits\CheckExistTitleBenefitStudentTask;
use Illuminate\Http\Request;

class CheckExistTitleBenefitStudentAction
{
    public function run(Request $request){
        $key = trim($request->get("title"));
        $id = trim($request->get("id"));
        return resolve(CheckExistTitleBenefitStudentTask::class)->run($key, $id);
    }
}
