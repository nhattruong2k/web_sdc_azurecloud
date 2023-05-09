<?php


namespace App\Tasks\News;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;

class CountNewsTask extends Task
{
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(){
        return $this->newsRepository->count();
    }
}
