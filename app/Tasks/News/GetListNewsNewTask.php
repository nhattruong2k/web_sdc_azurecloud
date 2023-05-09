<?php


namespace App\Tasks\News;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;

class GetListNewsNewTask extends Task
{
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run()
    {
        $columns = [
            'news.id',
            'news.title',
            'news.slug',
        ];

        $news = $this->newsRepository->scopeQuery(function ($query) {
            $query->active();
            return $query;
        });
        $news->orderBy('id', 'DESC');
        return $news->take(5)->get($columns);
    }
}
