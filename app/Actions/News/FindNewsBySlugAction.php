<?php
namespace App\Actions\News;
use App\Cores\Abstracts\Action;
use App\Tasks\News\FindNewsBySlugTask;

class FindNewsBySlugAction extends Action {
    public function run($slug)
    {
        $news = resolve(FindNewsBySlugTask::class)->run($slug);
        $news->keyword = explode(',', $news->keyword);
        return $news;
    }
}

?>
