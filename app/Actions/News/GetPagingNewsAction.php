<?php
namespace App\Actions\News;
use App\Cores\Abstracts\Action;
use App\Tasks\News\GetKeywordNewListTask;
use App\Tasks\News\GetPagingNewsTask;

class GetPagingNewsAction extends Action {
    public function run(array $param)
    {
        $news['data'] = resolve(GetPagingNewsTask::class)->run($param);
        $keywords = resolve(GetKeywordNewListTask::class)->run();
        $datas = '';
        foreach ($keywords as $keyword){
            $datas .= $keyword->keyword . ',';
        }
        $datas = trim($datas, ',');
        $datas = explode(',', implode(',', array_unique(explode(',', $datas))));
        $news['keywords'] = $datas;
        return $news;
    }
}

?>
