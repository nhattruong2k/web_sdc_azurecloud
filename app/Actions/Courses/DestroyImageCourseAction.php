<?php


namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Models\Course;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\Courses\FindCourseByIdTask;
use App\Tasks\Courses\UpdateCourseTask;

class DestroyImageCourseAction extends Action
{
    public function run($id, $imageName){
        resolve(FindCourseByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(Course::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateCourseTask::class)->run($data, $id);
        return true;
    }
}
