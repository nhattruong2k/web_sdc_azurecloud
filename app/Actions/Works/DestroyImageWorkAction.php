<?php


namespace App\Actions\Works;

use App\Cores\Abstracts\Action;
use App\Models\Work;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\Works\FindWorkByIdTask;
use App\Tasks\Works\UpdateWorkTask;

class DestroyImageWorkAction extends Action
{
    public function run($id, $imageName){
        resolve(FindWorkByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(Work::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateWorkTask::class)->run($data, $id);
        return true;
    }
}
