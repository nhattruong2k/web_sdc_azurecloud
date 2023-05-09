<?php


namespace App\Tasks\CourseCategories;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CourseCategoriesRepository;

class FindCourseCategoryByFieldTask extends Task
{
    protected $courseCategoriesRepository;
    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoryRepository = $courseCategoriesRepository;
    }

    public function run($field, $value){
        return $this->courseCategoryRepository->scopeQuery(function ($query) use($field, $value) {
            $query = $query->where($field, $value);
            return $query;
        })->exists();
    }
}
