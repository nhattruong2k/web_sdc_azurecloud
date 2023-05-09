<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\WorksRepository;

class GetRelateWorkTask extends Task
{
    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run(int $cateID, int $id, array $columns = ['*'])
    {
        return $this->worksRepository->active()->with('courseCategory:id,title,image')->where('course_category_id', $cateID)->where('id', '<>', $id)->select($columns)->get();
    }
}
