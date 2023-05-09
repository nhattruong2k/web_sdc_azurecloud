<?php

namespace App\Tasks\TeamTeachers;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\TeachersRepository;

class GetPagingTeachersTask extends Task
{

    protected TeachersRepository $teachersRepository;
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $teachers = $this->teachersRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('fullname', 'like', "%" . $param['search'] . "%")->orWhere('profession', 'like', "%" . $param['search'] . "%");
            }

            if (isset($param['role'])){
                $query->where('role', $param['role']);
            }

            if (!empty($param['status'])) {
                $query->where('status', $param['status']); 
            }
            return $query;
        });
        $teachers->orderBy($param['sortfield'], $param['sorttype']);
        return $teachers->RoleTeachers()->paginate($param['limit'], $columns);
    }
}
?>