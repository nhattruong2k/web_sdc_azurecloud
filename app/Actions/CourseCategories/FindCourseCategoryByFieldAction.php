<?php


namespace App\Actions\CourseCategories;


use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\FindCourseCategoryByFieldTask;

class FindCourseCategoryByFieldAction extends Action
{
    public function run($field, $value){
        return resolve(FindCourseCategoryByFieldTask::class)->run($field, $value);
    }
}
