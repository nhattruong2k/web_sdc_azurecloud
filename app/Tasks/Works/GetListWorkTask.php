<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\WorksRepository;

class GetListWorkTask extends Task
{
    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run($params, array $columns = ['*'])
    {
        $works = $this->worksRepository->active()->with('courseCategory:id,title,image')->select($columns);
        if (!empty($params['keyword'])){
            $works->where('keyword', 'like', "%" . $params['keyword'] . "%");
        }
        return $works->get();
    }
}
