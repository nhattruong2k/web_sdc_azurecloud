<?php
namespace App\Actions\CourseCategories;

use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\FindCourseCategoryByIdTask;
use App\Tasks\CourseCategories\GetListParentCourseCategoryTask;
use App\Tasks\CourseCategories\GetParentCourseCategoryTask;

class GetParentCourseCategoryAction extends Action {
    public function run($id = null, array $columns = ['*']){
        $courseCategories = resolve(GetListParentCourseCategoryTask::class)->run($id, $columns);
        if(!empty($id)){
            $courseCategory = resolve(FindCourseCategoryByIdTask::class)->run($id);
            return resolve(GetParentCourseCategoryTask::class)->run($courseCategories,  $courseCategory->parent_id);
        }
        return resolve(GetParentCourseCategoryTask::class)->run($courseCategories);
    }
}
?>
