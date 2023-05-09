<?php

namespace App\Tasks\Projectstudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\ProjectStudentsRepository;
use Exception;

class FindProjectStudentByIdTask extends Task
{
    protected ProjectStudentsRepository $projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }

    public function run(int $id, $columns = ['*'])
    {
        try {
            $projectStudent = $this->projectStudentsRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $projectStudent;
    }
}
