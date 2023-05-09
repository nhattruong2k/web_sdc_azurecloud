<?php
namespace App\Tasks\News;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;

class FindNewsByFieldTask extends Task
{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run($field, $value){
        return $this->newsRepository->scopeQuery(function ($query) use($field, $value) {
            $query = $query->where($field, $value);
            return $query;
        })->exists();
    }
}
