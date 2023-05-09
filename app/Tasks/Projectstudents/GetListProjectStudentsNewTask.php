<?php


namespace App\Tasks\Projectstudents;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\ProjectStudentsRepository;

class GetListProjectStudentsNewTask extends Task
{
    protected ProjectStudentsRepository $projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }

    public function run()
    {
        $columns = [
            'project_students.id',
            'project_students.title',
            'project_students.image',
            'project_students.description',
            'project_students.link',
        ];

        $projects = $this->projectStudentsRepository->scopeQuery(function ($query) {
            $query->active();
            return $query;
        });

        return $projects->take(6)->latest()->get($columns);
    }
}
