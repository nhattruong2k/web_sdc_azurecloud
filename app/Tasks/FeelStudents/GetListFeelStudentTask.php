<?php

namespace App\Tasks\FeelStudents;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\FeelStudentsRepository;

class GetListFeelStudentTask extends Task
{
    protected FeelStudentsRepository $feelStudentsRepository;

    public function __construct(FeelStudentsRepository $feelStudentsRepository)
    {
        $this->feelStudentsRepository = $feelStudentsRepository;
    }

    public function run($column = ['*']){
        $feelStudents = $this->feelStudentsRepository->active()->get($column);
        return $feelStudents;
    }
}
