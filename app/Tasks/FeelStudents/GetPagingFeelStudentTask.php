<?php

namespace App\Tasks\FeelStudents;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ConfigRepository;
use App\Repositories\Contracts\FeelStudentsRepository;

class GetPagingFeelStudentTask extends Task
{
    protected FeelStudentsRepository $feelStudentsRepository;

    public function __construct(FeelStudentsRepository $feelStudentsRepository)
    {
        $this->feelStudentsRepository = $feelStudentsRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'feel_students.id',
            'feel_students.name',
            'feel_students.content',
            'feel_students.avatar',
            'feel_students.status',
        ];
        $feelStudents = $this->feelStudentsRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('feel_students.name', 'like', "%" . $param['search'] . "%");
            }
            return $q;
        });
        $feelStudents->orderBy($param['sortfield'], $param['sorttype']);
   
        return $feelStudents->paginate($param['limit'], $columns);
    }
}