<?php

namespace App\Tasks\Questions;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\QuestionRepository;

class CheckExistQuestionTask extends Task
{
    public QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function run($question, $id = null)
    {
        return $this->questionRepository->scopeQuery(function ($query) use($question, $id) {
            $query = $query->where('question', $question);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
