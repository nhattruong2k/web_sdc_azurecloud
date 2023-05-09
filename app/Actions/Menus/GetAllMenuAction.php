<?php


namespace App\Actions\Menus;


use App\Cores\Abstracts\Action;
use App\Tasks\Menus\GetAllMenuActiveTask;
use App\Tasks\Menus\GetTreeMenuTask;

class GetAllMenuAction extends Action
{
    public function run(){
        $menus =  resolve(GetAllMenuActiveTask::class)->run();
        return resolve(GetTreeMenuTask::class)->buildTree($menus);
    }
}
