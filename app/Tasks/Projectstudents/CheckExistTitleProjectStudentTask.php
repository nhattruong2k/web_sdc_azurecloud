<?php


namespace App\Tasks\Projectstudents;

use App\Repositories\Contracts\ProjectStudentsRepository;

class CheckExistTitleProjectStudentTask
{
    protected ProjectStudentsRepository $projectStudentsRepository;

    public function __construct(ProjectStudentsRepository $projectStudentsRepository)
    {
        $this->projectStudentsRepository = $projectStudentsRepository;
    }

    public function run($title, $id = null)
    {
        return $this->projectStudentsRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->where('title', $title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
