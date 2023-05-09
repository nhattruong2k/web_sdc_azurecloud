<?php


namespace App\Actions\News;


use App\Cores\Abstracts\Action;
use App\Tasks\News\CountNewsTask;

class CountNewsAction extends Action
{
    public function run(){
        return resolve(CountNewsTask::class)->run();
    }
}
