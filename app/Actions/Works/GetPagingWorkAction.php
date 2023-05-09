<?php

namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Tasks\Works\GetKeywordWorkListTask;
use App\Tasks\Works\GetPagingWorkTask;

class GetPagingWorkAction extends Action
{

    public function run(array $param)
    {
        $works['data'] = resolve(GetPagingWorkTask::class)->run($param);
        $keywords = resolve(GetKeywordWorkListTask::class)->run();
        $datas = '';    
        foreach ($keywords as $keyword){
            $datas .= $keyword->keyword . ',';
        }
        $datas = trim($datas, ',');
        $datas = explode(',', implode(',', array_unique(explode(',', $datas))));
        $works['keywords'] = $datas;
        return $works;
    }
}
