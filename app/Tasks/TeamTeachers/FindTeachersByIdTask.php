<?php 
namespace App\Tasks\TeamTeachers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindTeachersByIdTask extends Task{
    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }
    
    public function run(int $id, $columns = ['*'])
    {
        try {
            $teachers = $this->teachersRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $teachers;
    }  
}
?>