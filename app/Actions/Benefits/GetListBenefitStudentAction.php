<?php


namespace App\Actions\Benefits;


use App\Cores\Abstracts\Action;
use App\Tasks\Benefits\GetListBenefitStudentTask;

class GetListBenefitStudentAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetListBenefitStudentTask::class)->run($column);
    }
}
