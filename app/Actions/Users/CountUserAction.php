<?php


namespace App\Actions\Users;


use App\Cores\Abstracts\Action;
use App\Tasks\Users\CountUserTask;

class CountUserAction extends Action
{
    public function run(){
        return resolve(CountUserTask::class)->run();
    }
}
