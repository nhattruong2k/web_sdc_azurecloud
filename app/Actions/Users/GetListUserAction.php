<?php


namespace App\Actions\Users;


use App\Cores\Abstracts\Action;
use App\Tasks\Users\GetListUserTask;

class GetListUserAction extends Action
{
    public function run(){
        $materials = resolve(GetListUserTask::class)->run();
        return ['' => __('common.choose')] + $materials->toArray();
    }
}
