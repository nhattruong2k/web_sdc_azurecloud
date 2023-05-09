<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\WorksRepository;

class GetKeywordWorkListTask extends Task
{
    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run(){
        return $this->worksRepository->select('keyword')->orderBy('id', 'ASC')->limit(6)->get();
    }
}
