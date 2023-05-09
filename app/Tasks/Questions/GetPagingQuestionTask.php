<?php

namespace App\Tasks\Questions;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\QuestionRepository;

class GetPagingQuestionTask extends Task
{
    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'questions.id',
            'questions.question',
            'questions.answer',
            'questions.status',
        ];
        $questions = $this->questionRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('questions.question', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $questions->orderBy($param['sortfield'], $param['sorttype']);
   
        return $questions->paginate($param['limit'], $columns);
    }
}