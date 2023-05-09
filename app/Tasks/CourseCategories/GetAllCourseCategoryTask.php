<?php


namespace App\Tasks\CourseCategories;


use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\CourseCategoriesRepository;

class GetAllCourseCategoryTask extends Task
{
    protected CourseCategoriesRepository $courseCategoriesRepository;

    public function __construct(CourseCategoriesRepository $courseCategoriesRepository)
    {
        $this->courseCategoriesRepository = $courseCategoriesRepository;
    }

    public function run($columns = ['*'])
    {
        return $this->courseCategoriesRepository->active()->orderBy('order', 'ASC')->get($columns);
    }
}
