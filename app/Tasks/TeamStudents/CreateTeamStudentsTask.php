<?php 
namespace App\Tasks\TeamStudents;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class CreateTeamStudentsTask extends Task {
    protected StudentsRepository $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }
    public function run(array $data)
    {   
        try {
            $students = $this->studentsRepository->create($data); 
        } catch (Exception $ex) {
            throw new InternalErrorException(__('student.create_error'));
        }
        return $students;
    }
}
?>