<?php

namespace App\Tasks\Questions;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use Exception;
use App\Exceptions\InternalErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\QuestionRepository;

class UpdateQuestionTask extends Task
{
    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function run($data, int $id)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $question = $this->questionRepository->update($data, $id);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('questions.update_error'));
        }
        return $question;
    }
}
