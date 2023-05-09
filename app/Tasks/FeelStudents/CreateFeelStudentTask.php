<?php

namespace App\Tasks\FeelStudents;

use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\FeelStudentsRepository;
use Exception;

class CreateFeelStudentTask extends Task
{

    protected FeelStudentsRepository $feelStudentsRepository;

    public function __construct(FeelStudentsRepository $feelStudentsRepository)
    {
        $this->feelStudentsRepository = $feelStudentsRepository;
    }

    public function run(array $data)
    {
        try {
            $feelStudent = $this->feelStudentsRepository->create($data);    
        } catch (Exception $ex) {
            throw new InternalErrorException(__('feel_students.create_error'));   
        }
        return $feelStudent;
    }
}
