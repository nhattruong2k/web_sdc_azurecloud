<?php


namespace App\Actions\Projectstudents;

use App\Cores\Abstracts\Action;
use App\Models\ProjectStudent;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\Projectstudents\FindProjectStudentByIdTask;
use App\Tasks\Projectstudents\UpdateProjectStudentTask;

class DestroyImageProjectStudentAction extends Action
{
    public function run($id, $imageName){
        resolve(FindProjectStudentByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(ProjectStudent::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateProjectStudentTask::class)->run($data, $id);
        return true;
    }
}
