<?php 
namespace App\Tasks\TeamTeachers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class CreateTeamTeachersTask extends Task {
    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }
    public function run(array $data)
    {   
        try {   
            $teachers = $this->teachersRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('teacher.create_error'));
        }
        return $teachers;
    }
}
?>