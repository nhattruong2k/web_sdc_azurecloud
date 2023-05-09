<?php

namespace App\Actions\Questions;

use App\Cores\Abstracts\Action;
use App\Tasks\Questions\FindQuestionByIdTask;

class FindQuestionByIdAction extends Action
{
    public function run(int  $id, array $columns = ['*'])
    {
        return resolve(FindQuestionByIdTask::class)->run($id, $columns);
    }
}
