<?php

namespace App\Tasks\TeamTeachers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;

class GetAllTeachersTask extends Task
{
    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }

    public function run(){

        $teachers = $this->teachersRepository->RoleTeachers()->active()->get([
            'id','slug','fullname','profession','description','avatar',
        ]);
        return $teachers;
    }
}
