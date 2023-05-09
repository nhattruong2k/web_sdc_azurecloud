<?php


namespace App\Actions\CourseCategories;

use App\Cores\Abstracts\Action;
use App\Models\CourseCategories;
use App\Tasks\Commons\DestroyImageTask;
use App\Tasks\CourseCategories\FindCourseCategoryByIdTask;
use App\Tasks\CourseCategories\UpdateCourseCategoryTask;

class DestroyImageCourseCategoryAction extends Action
{
    public function run($id, $imageName){
        resolve(FindCourseCategoryByIdTask::class)->run($id);
        $data['image'] = '';
        $pathFolder = sprintf(CourseCategories::FOLDER_IMAGES);
        resolve(DestroyImageTask::class)->run($pathFolder . '/' . $imageName);
        resolve(UpdateCourseCategoryTask::class)->run($data, $id);
        return true;
    }
}
