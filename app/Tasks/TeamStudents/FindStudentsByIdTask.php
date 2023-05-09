<?php 
namespace App\Tasks\TeamStudents;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindStudentsByIdTask extends Task{
    protected StudentsRepository $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }
    
    public function run(int $id, $columns = ['*'])
    {
        try {
            $students = $this->studentsRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $students;
    }  
}
?>