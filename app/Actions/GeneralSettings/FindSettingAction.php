<?php

namespace App\Actions\GeneralSettings;

use App\Cores\Abstracts\Action;
use App\Tasks\GeneralSettings\FindSettingTask;

class FindSettingAction extends Action
{
    public function run($column = ['*']){
        return resolve(FindSettingTask::class)->run($column);
    }
}
