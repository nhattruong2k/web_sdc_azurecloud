<?php 
namespace App\Tasks\TeamStudents;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindStudentsBySlugTask extends Task{
    protected StudentsRepository $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }
    
    public function run($slug)
    {
        try {
            $students = $this->studentsRepository->where('slug', $slug)->Student()->first();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $students;
    }  
}
?>