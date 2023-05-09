<?php

namespace App\Tasks\TeamStudents;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StudentsRepository;

class GetPagingStudentsTask extends Task
{

    protected StudentsRepository $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        
        $students = $this->studentsRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('fullname', 'like', "%" . $param['search'] . "%")->orWhere('position', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('status', $param['status']);
            }
            return $query;
        });
        $students->orderBy($param['sortfield'], $param['sorttype']);
        return $students->RoleStudents()->paginate($param['limit'], $columns);
    }
}
?>