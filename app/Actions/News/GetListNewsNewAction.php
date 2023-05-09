<?php


namespace App\Actions\News;


use App\Cores\Abstracts\Action;
use App\Tasks\News\GetListNewsNewTask;

class GetListNewsNewAction extends Action
{
    public function run(){
        return resolve(GetListNewsNewTask::class)->run();
    }
}
