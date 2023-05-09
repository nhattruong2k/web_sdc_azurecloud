<?php

namespace App\Actions\Questions;

use App\Cores\Abstracts\Action;
use App\Tasks\Questions\CreateQuestionTask;
use Illuminate\Http\Request;

class CreateQuestionAction extends Action
{
    public function run (Request $request)
    {
        $data = $request->all();
        return resolve(CreateQuestionTask::class)->run($data);
    }
}