<?php

namespace App\Actions\Questions;

use App\Cores\Abstracts\Action;
use App\Tasks\Questions\GetPagingQuestionTask;

class GetPagingQuestionAction extends Action
{
    public function run(array $param)
    {
        return resolve(GetPagingQuestionTask::class)->run($param);
    }
}