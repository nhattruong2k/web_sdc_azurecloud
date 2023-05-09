<?php 
namespace App\Tasks\TeamTeachers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindTeachersBySlugTask extends Task{
    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }
    
    public function run($slug)
    {
        try {
            $teachers = $this->teachersRepository->where('slug', $slug)->RoleTeachers()->first();
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $teachers;
    }  
}
?>