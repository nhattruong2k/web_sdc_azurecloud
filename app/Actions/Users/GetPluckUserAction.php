<?php


namespace App\Actions\Users;

use App\Cores\Abstracts\Action;
use App\Tasks\Users\GetPluckUserTask;

class GetPluckUserAction extends Action
{
    public function run(){
        return resolve(GetPluckUserTask::class)->run();
    }
}
