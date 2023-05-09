<?php

namespace App\Actions\Courses;

use App\Cores\Abstracts\Action;
use App\Tasks\CourseCategories\GetAllCourseCategoryTask;
use App\Tasks\Courses\GetAllCourseByCategoryTask;

class GetAllCourseByCategoryAction extends Action
{

    public function run($param, array $columns = ['*'])
    {
        $courses_categories = resolve(GetAllCourseCategoryTask::class)->run(['id', 'title', 'slug']);
        $courses = resolve(GetAllCourseByCategoryTask::class)->run($courses_categories, $param, $columns);
        return $courses;
    }
}