<?php


namespace App\Actions\CourseCategories;


use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\FindCourseCategoryByIdTask;
use App\Tasks\CourseCategories\GetAllCourseCategoryTask;
use App\Tasks\CourseCategories\GetParentCourseCategoryTask;
use App\Tasks\CourseCategories\GetTreeCourseCategoryTask;

class GetTreeCourseCategoryAction extends Action
{
    public function run($id = null){
        $courseCategories = resolve(GetAllCourseCategoryTask::class)->run();
        if(!empty($id)){
            resolve(FindCourseCategoryByIdTask::class)->run($id);
            return resolve(GetTreeCourseCategoryTask::class)->run($courseCategories,  $id);
        }
        return resolve(GetTreeCourseCategoryTask::class)->run($courseCategories);
    }

    public function getTree(){
        $courseCategories =  resolve(GetAllCourseCategoryTask::class)->run();
        return resolve(GetParentCourseCategoryTask::class)->buildTree($courseCategories);
    }
}
