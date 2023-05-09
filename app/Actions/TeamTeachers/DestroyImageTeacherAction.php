<?php


namespace App\Actions\TeamTeachers;

use App\Cores\Abstracts\Action;
use App\Models\TeamTeachers;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\TeamTeachers\FindTeachersByIdTask;
use App\Tasks\TeamTeachers\UpdateTeachersTask;

class DestroyImageTeacherAction extends Action
{
    public function run($id, $imageName){
        resolve(FindTeachersByIdTask::class)->run($id);
        $data['avatar'] = '';
        $pathFolder = sprintf(TeamTeachers::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateTeachersTask::class)->run($data, $id);
        return true;
    }
}
