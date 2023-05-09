<?php

namespace App\Tasks\Questions;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\QuestionRepository;
use Exception;

class CreateQuestionTask extends Task
{

    public QuestionRepository $questionRepository;
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }
    public function run(array $data)
    {
        try {
            $question = $this->questionRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('questions.create_error'));   
        }
        return $question;
    }
}
