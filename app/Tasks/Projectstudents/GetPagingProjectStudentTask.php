<?php

namespace App\Tasks\Projectstudents;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ProjectStudentsRepository;

class GetPagingProjectStudentTask extends Task
{
    protected ProjectStudentsRepository $projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'project_students.id',
            'project_students.title',
            'project_students.image',
            'project_students.description',
            'project_students.status',
            'project_students.link',
        ];
        $projectStudents = $this->projectStudentsRepository->scopeQuery(function ($q) use ($param){
            if (isset($param['search']) && $param['search']){
                $q->where('project_students.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['status'])) {
                $q->where('project_students.status', $param['status']);
            }
            return $q;
        });
        $projectStudents->orderBy($param['sortfield'], $param['sorttype']);
   
        return $projectStudents->paginate($param['limit'], $columns);
    }
}