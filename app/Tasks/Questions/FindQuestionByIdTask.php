<?php

namespace App\Tasks\Questions;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\QuestionRepository;
use Exception;

class FindQuestionByIdTask extends Task
{
    public QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $question = $this->questionRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $question;
    }
}
