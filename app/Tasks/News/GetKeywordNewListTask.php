<?php

namespace App\Tasks\News;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;

class GetKeywordNewListTask extends Task
{
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(){
        return $this->newsRepository->select('keyword')->orderBy('id', 'ASC')->limit(6)->get();
    }
}
