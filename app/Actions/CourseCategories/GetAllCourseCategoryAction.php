<?php


namespace App\Actions\CourseCategories;


use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\GetAllCourseCategoryTask;

class GetAllCourseCategoryAction extends Action
{
    public function run(){
        return resolve(GetAllCourseCategoryTask::class)->run();
    }
}
