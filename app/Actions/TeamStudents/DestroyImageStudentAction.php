<?php


namespace App\Actions\TeamStudents;

use App\Cores\Abstracts\Action;
use App\Models\TeamStudents;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\TeamTeachers\FindTeachersByIdTask;
use App\Tasks\TeamTeachers\UpdateTeachersTask;

class DestroyImageStudentAction extends Action
{
    public function run($id, $imageName){
        resolve(FindTeachersByIdTask::class)->run($id);
        $data['avatar'] = '';
        $pathFolder = sprintf(TeamStudents::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateTeachersTask::class)->run($data, $id);
        return true;
    }
}
