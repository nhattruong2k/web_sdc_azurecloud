<?php
namespace App\Actions\Config;
use App\Cores\Abstracts\Action;
use App\Tasks\Config\GetAllConfigsTask;

class GetAllConfigsAction extends Action
{
    public function run($column = ['*']){
        return resolve(GetAllConfigsTask::class)->run($column);
    }
}
