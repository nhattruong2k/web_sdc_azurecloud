<?php

namespace App\Tasks\FeelStudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\FeelStudentsRepository;
use Exception;

class FindFeelStudentByIdTask extends Task
{
    protected FeelStudentsRepository $feelStudentsRepository;

    public function __construct(FeelStudentsRepository $feelStudentsRepository)
    {
        $this->feelStudentsRepository = $feelStudentsRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $feelStudents = $this->feelStudentsRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $feelStudents;
    }
}
