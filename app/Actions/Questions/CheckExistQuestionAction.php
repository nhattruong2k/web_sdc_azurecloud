<?php


namespace App\Actions\Questions;

use App\Cores\Abstracts\Action;
use App\Tasks\Questions\CheckExistQuestionTask;
use Illuminate\Http\Request;

class CheckExistQuestionAction extends Action
{
    public function run(Request $request){
        $question = trim($request->get("question"));
        $id = trim($request->get("id"));
        return resolve(CheckExistQuestionTask::class)->run($question, $id);
    }
}
