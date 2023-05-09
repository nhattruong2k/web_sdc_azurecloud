<?php

namespace App\Actions\Benefits;

use App\Cores\Abstracts\Action;
use App\Tasks\Benefits\GetPagingBenefitStudentTask;

class GetPagingBenefitStudentAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingBenefitStudentTask::class)->run($param);
    }
}