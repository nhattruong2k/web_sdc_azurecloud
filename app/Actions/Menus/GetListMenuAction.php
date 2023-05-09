<?php


namespace App\Actions\Menus;


use App\Cores\Abstracts\Action;
use App\Tasks\Menus\GetListMenuTask;

class GetListMenuAction extends Action
{
    public function run($id, array $param){
        return resolve(GetListMenuTask::class)->run($id, $param);
    }
}
