<?php


namespace App\Actions\statistNumbers;

use App\Cores\Abstracts\Action;
use App\Models\StatistNumber;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\StatistNumbers\FindStatistNumbersByIdTask;
use App\Tasks\StatistNumbers\UpdateStatistNumbersTask;

class DestroyImageStatistNumberAction extends Action
{
    public function run($id, $imageName){
        resolve(FindStatistNumbersByIdTask::class)->run($id);
        $data['icon'] = '';
        $pathFolder = sprintf(StatistNumber::FOLDER_ICONS);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateStatistNumbersTask::class)->run($data, $id);
        return true;
    }
}
