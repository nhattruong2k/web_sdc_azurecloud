<?php
namespace App\Actions\News;


use App\Cores\Abstracts\Action;
use  App\Tasks\News\FindNewsByFieldTask;

class FindNewsByFieldAction extends Action
{
    public function run($field, $value){
        return resolve(FindNewsByFieldTask::class)->run($field, $value);
    }
}
?>