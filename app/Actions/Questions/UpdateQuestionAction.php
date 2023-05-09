<?php

namespace App\Actions\Questions;

use App\Cores\Abstracts\Action;
use App\Tasks\Questions\FindQuestionByIdTask;
use App\Tasks\Questions\UpdateQuestionTask;
use Illuminate\Http\Request;

class UpdateQuestionAction extends Action
{
    public function run(int $id, Request $request)
    {
        $question = resolve(FindQuestionByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        return resolve(UpdateQuestionTask::class)->run($data, $question->id);
    }
}
