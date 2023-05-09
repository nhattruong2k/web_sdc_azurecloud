<?php


namespace App\Actions\CourseCategories;


use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\GetPluckCourseCategoryTask;

class GetPluckCourseCategoryAction extends Action
{
    public function run($id = null){
        $parameters = resolve(GetPluckCourseCategoryTask::class)->run($id);
        return ['' => __('common.choose')] + $parameters->toArray();
    }
}
