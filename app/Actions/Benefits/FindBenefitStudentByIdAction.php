<?php

namespace App\Actions\Benefits;

use App\Cores\Abstracts\Action;
use App\Tasks\Benefits\FindBenefitStudentByIdTask;

class FindBenefitStudentByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindBenefitStudentByIdTask::class)->run($id, $columns);
    }
}
