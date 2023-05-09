<?php

namespace App\Tasks\Projectstudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\ProjectStudentsRepository;
use Exception;

class CreateProjectStudentTask extends Task
{
    public ProjectStudentsRepository $projectStudentsRepository;
    
    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }
    public function run(array $data)
    {
        try {
            $projectStudent = $this->projectStudentsRepository->create($data);    
        } catch (Exception $ex) {
            throw new InternalErrorException(__('project_students.create_error'));   
        }
        return $projectStudent;
    }
}
