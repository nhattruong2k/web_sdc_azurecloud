<?php


namespace App\Tasks\TeamStudents;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;

class GetAllStudentTask extends Task
{
    protected $studentRepository;

    public function __construct(StudentsRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function run($column = ['*']){
        $students = $this->studentRepository->student()->active()->select($column)->get();
        return $students;
    }
}
