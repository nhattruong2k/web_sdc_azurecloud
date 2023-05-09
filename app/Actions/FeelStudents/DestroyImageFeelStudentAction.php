<?php


namespace App\Actions\FeelStudents;

use App\Cores\Abstracts\Action;
use App\Models\FeelStudent;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\FeelStudents\FindFeelStudentByIdTask;
use App\Tasks\FeelStudents\UpdateFeelStudentTask;

class DestroyImageFeelStudentAction extends Action
{
    public function run($id, $imageName){
        resolve(FindFeelStudentByIdTask::class)->run($id);
        $data['avatar'] = '';
        $pathFolder = sprintf(FeelStudent::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateFeelStudentTask::class)->run($data, $id);
        return true;
    }
}
