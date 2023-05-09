<?php

namespace App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\Tasks\Category\GetAllCategoryTask;
use App\Tasks\CourseCategories\GetAllCourseCategoryTask;

class GetMenuCategoryAction extends Action
{
    public function run(){
        $categories = resolve(GetAllCategoryTask::class)->run(['id','title','slug','image']);
        $course_categories = resolve(GetAllCourseCategoryTask::class)->run(['id','title','slug','image']);
        $menu_category = [
            'categories' => $categories,
            'course_categories' => $course_categories,
        ];
        return $menu_category;
    }
}
